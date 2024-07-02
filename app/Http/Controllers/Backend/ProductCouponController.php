<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCouponRequest;
use App\Models\Backend\ProductCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCouponController extends Controller
{
    public function index()
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'manage_product_coupons,show_product_coupons')) {
            return redirect('admin/index');
        }


        $coupons = ProductCoupon::query()
            ->when(\request()->keywords != null, function ($query) {
                $query->search(\request()->keywords);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.product_coupons.index', compact('coupons'));
    }


    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_product_coupons')) {
            return redirect('admin/index');
        }

//        return view('backend.product_coupons.create');

    }


    public function store(ProductCouponRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_product_coupons')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {

            $input['code'] = $request->code;
            $input['type'] = $request->type;
            $input['value'] = $request->value;
            $input['description'] = ['ar'=>$request->description['ar'],'en'=>$request->description['en']];
            $input['use_times'] = $request->use_times;
            $input['used_times'] = 0;
            $input['start_date'] = $request->start_date;
            $input['expire_date'] = $request->expire_date;
            $input['greater_than'] = $request->greater_than;
            $input['status'] = $request->status;
            $input['created_by'] = Auth::id();

            ProductCoupon::create($input);
            DB::commit();
            Session::flash('message', trans('coupons.coupon add success'));
            Session::flash('type', trans('coupons.Add Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.product_coupons.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }



    }



    public function edit(ProductCoupon $ProductCoupon)
    {

        if (!auth()->user()->ability('admin', 'update_product_coupons')) {
            return redirect('admin/index');
        }

//        return view('backend.product_coupons.edit',compact('ProductCoupon'));

    }


    public function update(ProductCouponRequest $request, ProductCoupon $productCoupon)
    {
        if (!auth()->user()->ability('admin', 'update_product_coupons')) {
            return redirect('admin/index');
        }

        DB::beginTransaction();
        try {

            $input['code'] = $request->code;
            $input['type'] = $request->type;
            $input['value'] = $request->value;
            $input['description'] = ['ar'=>$request->description['ar'],'en'=>$request->description['en']];
            $input['use_times'] = $request->use_times;
            $input['used_times'] = 0;
            $input['start_date'] = $request->start_date;
            $input['expire_date'] = $request->expire_date;
            $input['greater_than'] = $request->greater_than;
            $input['status'] = $request->status;
            $input['updated_by'] = Auth::id();

            $productCoupon->update($input);

            DB::commit();
            Session::flash('message', trans('coupons.coupon update success'));
            Session::flash('type', trans('coupons.update Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.product_coupons.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }


    }


    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_product_coupons')) {
            return redirect('admin/index');
        }

        $coupon = ProductCoupon::findOrFail($id);
        $coupon->deleted_by = Auth::id();
        $coupon->save();
        ProductCoupon::findOrFail($id)->delete();


            return response()->json(array("exists" => true));


    }







}
