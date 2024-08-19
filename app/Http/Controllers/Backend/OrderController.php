<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index()
    {

        //permissions user access
        if (!auth()->user()->ability('admin', 'manage_orders,show_orders')) {
            return redirect('admin/index');
        }


        $orders= Order::query()
            ->when(\request()->keywords != null, function ($query) {
                $query->search(\request()->keywords);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereOrderStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.orders.index', compact('orders'));
    }


    public function create()
    {
        return view('backend.tags.create');

    }


    public function store(Request $request)
    {
        //permissions user access
        if (!auth()->user()->ability('admin','create_orders')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {

            DB::commit();
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }
        return redirect()->back();


    }


    public function show(Order $order)
    {


        $order_status_array = [
            '0' => 'New order',
            '1' => 'Paid',
            '2' => 'Under process',
            '3' => 'Finished',
            '4' => 'Rejected',
            '5' => 'Canceled',
            '6' => 'Refund requested',
            '7' => 'Returned order',
            '8' => 'Refunded',
        ];

        $key = array_search($order->order_status, array_keys($order_status_array));
        foreach ($order_status_array as $k => $v) {
            if ($k < $key) {
                unset($order_status_array[$k]);
            }
        }


        return view('backend.orders.show',compact('order','order_status_array'));

    }
    public function edit(Order $order)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_orders')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {





        DB::commit();
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }
        return view('backend.orders.edit',compact('order'));


    }


    public function update(Request $request, Order $order)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_orders')) {
            return redirect('admin/index');
        }
            
        $order->update(['order_status'=> $request->order_status]);

        $order->transactions()->create([
            'transaction' => $request->order_status,
            'transaction_number'=> null,
            'payment_result'=> null,
        ]);

        Alert::success('DONE', 'updated successfully')->showConfirmButton('OK', '#3BB77E');
        return back();



    }

    public function destroy($id)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'delete_orders')) {
            return redirect('admin/index');
        }

        $deletedis = Order::findOrFail($id)->delete();

        return response()->json(array("exists" => true));
    }

}
