<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CheckupHistoryListResource;
use App\Models\CheckupHistory;
use App\Models\Medecine\Medecine;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserHistoryController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->input('page', 1); // default 1
        $perPage = $request->input('perPage', 50); // default 50
        $queryString = $request->input('query', null);
        $sort = explode('.', $request->input('sort', 'id'));
        $order = $request->input('order', 'asc');

        $data = CheckupHistory::query()
            ->with(['service'])
            ->where(function ($query) use ($queryString) {
                if ($queryString && $queryString != '') {
                }
            })
            ->where('user_id', auth()->user()->id)
            ->when(count($sort) == 1, function ($query) use ($sort, $order) {
                $query->orderBy($sort[0], $order);
            })
            ->paginate($perPage)
            ->withQueryString();


       


        $props = [
            'medicine' => Medecine::all(),
            'data' => CheckupHistoryListResource::collection($data),
            'params' => $request->all(),
        ];

        // dd($props);

        if ($request->wantsJson()) {
            return json_encode($props);
        }

        if (count($data) <= 0 && $page > 1) {
            return redirect()->route('dental_services.index', ['page' => 1]);
        }

        return Inertia::render('Customer/History', $props);
    }
}
