<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Payment\PaymentListResource;
use App\Models\Payment\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->input('page', 1); // default 1
        $perPage = $request->input('perPage', 50); // default 50
        $queryString = $request->input('query', null);
        $sort = explode('.', $request->input('sort', 'id'));
        $order = $request->input('order', 'asc');

        $data = Payment::query()
            ->with(['user'])
            ->leftJoin('users as user', 'payments.user_id', '=', 'user.id')
            ->select('payments.*', 'user.name')
            ->where(function ($query) use ($queryString) {
                if ($queryString && $queryString != '') {
                    $query->where('user.name', 'like', '%' . $queryString . '%')
                    ->orWhere('payment_method', 'like', '%' . $queryString . '%')
                    ->orWhere('payment_status', 'like', '%' . $queryString . '%')
                    ->orWhere(DB::raw("DATE_FORMAT(payments.created_at, '%m/%d/%Y')"), 'like',  '%' . $queryString . '%')
                    ->orWhere('amount', 'like', '%' . $queryString . '%');

                }
            })
            ->when(count($sort) == 1, function ($query) use ($sort, $order) {
                $query->orderBy($sort[0], $order);
            })
            ->paginate($perPage)
            ->withQueryString();


       


        $props = [
            'data' => PaymentListResource::collection($data),
            'params' => $request->all(),
        ];

        if ($request->wantsJson()) {
            return json_encode($props);
        }

        if (count($data) <= 0 && $page > 1) {
            return redirect()->route('dental_services.index', ['page' => 1]);
        }

        return Inertia::render('Admin/Payment/Index', $props);
    }
    public function destroy(Request $request, string $id)
    {
        $data = Payment::findOrFail($id);
        $data->delete();
        sleep(1);

        if ($request->wantsJson()) {
            return response(null, 204);
        }
        return redirect()->back();
    }
   
}
