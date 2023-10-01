<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckupHistoryRequest;
use App\Http\Requests\UpdateCheckupHistoryRequest;
use App\Http\Resources\Admin\DentalServiceListResource;
use App\Http\Resources\CheckupHistoryListResource;
use App\Http\Resources\User\UserLisResource;
use App\Models\Admin\DentalService;
use App\Models\CheckupHistory;
use App\Models\Medecine\Medecine;
use App\Models\Prescription\Prescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserCheckupHistoryController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->input('page', 1); // default 1
        $perPage = $request->input('perPage', 50); // default 50
        $queryString = $request->input('query', null);
        $sort = explode('.', $request->input('sort', 'id'));
        $order = $request->input('order', 'asc');

        $data = User::query()
            ->with([])
            ->where(function ($query) use ($queryString) {
                if ($queryString && $queryString != '') {
                    $query->where('name', 'like', '%' . $queryString . '%')
                    ->orWhere('mobile_no', 'like', '%' . $queryString . '%')
                    ->orWhere('email', 'like', '%' . $queryString . '%');

                }
            })
            ->where('email', "!=", 'admin@admin.com')
            ->where('email', "!=", 'dentist@admin.com')
            ->orderBy('created_at', 'DESC')
            ->when(count($sort) == 1, function ($query) use ($sort, $order) {
                $query->orderBy($sort[0], $order);
            })
            ->paginate($perPage)
            ->withQueryString();


       


        $props = [
            'data' => UserLisResource::collection($data),
            'params' => $request->all(),
        ];

        if ($request->wantsJson()) {
            return json_encode($props);
        }

        if (count($data) <= 0 && $page > 1) {
            return redirect()->route('dental_services.index', ['page' => 1]);
        }

        return Inertia::render('Admin/UserCheckupHistory/Index', $props);
    }

    public function store(StoreCheckupHistoryRequest $request)
    {
        $data = $request->all();



        
        foreach ($request->input('prescription') as $prescription) {
            $medicine = Medecine::where('id', $prescription['medecine_id'])->first();
            $medicine->update([
                'quantity' => $medicine->quantity - $prescription['quantity']
            ]);
        }
        // Medecine::where('model_id', $id)->where('collection_name', 'xray');


        $services = CheckupHistory::create([
            'user_id' => $data['user_id'],
            'description' => $data['description'],
            'date' => $data['date'],
            'service_id' => $data['service_id'],
            'xray' => json_encode($data['xray']),
            'title' => $data['title'],
            'prescription' => json_encode($data['prescription']),
        ]);


        if ($request->has('xray')) {

            foreach ($request->xray as $xray) {
                Media::where('id', $xray['id'])
                    ->update([
                        'model_id' => $services->id
                    ]);
            }
        }
       

        return Redirect::back()->with('status', 'Services created successfully!');
    }

    
    public function show(Request $request, string $id)
    {
        $services = DentalService::all();
        $user = User::where('id', $id)->first();
        $history = CheckupHistory::where('user_id', $id)->orderBy('date', 'DESC')->get();
        $props = [
            'medicine' => Medecine::all(),
            'services' => $services,
             'user' => $user,  
             'history' => $history
        ];
       

        return Inertia::render('Admin/UserCheckupHistory/Show',$props);
    }
    public function update(UpdateCheckupHistoryRequest $request, string $id)
    {
        $history = CheckupHistory::findOrFail($id);
      
        if ($request->has('photo')) {

            Media::where('model_id', $id)->where('collection_name', 'xray')
                ->where('model_type', 'App\Models\CheckupHistory')
                ->update([
                    'model_id' =>  0
                ]);

            if ($request->has('xray')) {
                foreach ($request->xray as $xray) {
                    Media::where('id', $xray['id'])
                        ->update([
                            'model_id' => $history->id
                        ]);
                }
            }
            $history->update([
                'xray' => json_encode($request->xray)
            ]);
        } else {
            $history->clearMediaCollection('xray');
        }

        sleep(1);

        $history->update($request->validated());
        if ($request->wantsJson()) {
            return (new CheckupHistoryListResource($history))
                ->response()
                ->setStatusCode(201);
        }

        return redirect()->back();
    }

}
