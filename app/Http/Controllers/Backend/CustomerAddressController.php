<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerAddressRequest;
use App\Models\Backend\City;
use App\Models\Backend\Country;
use App\Models\Backend\State;
use App\Models\User;
use App\Models\Backend\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerAddressController extends Controller
{
    public function index()
    {

        //permissions user access
        if (!auth()->user()->ability('admin', 'manage_customer_addresses,show_customer_addresses')) {
            return redirect('admin/index');
        }


        $customer_addresses = UserAddress::with('user')
            ->when(\request()->keywords != null, function ($query) {
                $query->search(\request()->keywords);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereDefaultAddress(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        $countries = Country::whereStatus(true)->get(['id','name']);
        $customers = User::whereHas('roles',function ($query){
           $query->where('name','customer');
        })->get();

        $customer_addresses_count = UserAddress::all()->count();

        return view('backend.customer_addresses.index', compact('customer_addresses','customers','countries','customer_addresses_count'));
    }


    public function create()
    {

        if (!auth()->user()->ability('admin','create_customer_addresses')) {
            return redirect('admin/index');
        }





        return view('backend.customer_addresses.create',compact('countries'));

    }


    public function store(CustomerAddressRequest $request)
    {
        //permissions user access
        if (!auth()->user()->ability('admin','create_customer_addresses')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {

            UserAddress::create($request->validated());


            DB::commit();
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }

        Session::flash('message', trans('customers.customer add success'));
        Session::flash('type', trans('customers.Add Successfully'));
        Session::flash('alert-type', 'success');
        return redirect()->route('admin.customer_addresses.index');


    }


    public function show($id)
    {
        return view('backend.tag.show');

    }


    public function edit(UserAddress $customer_address)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_customer_addresses')) {
            return redirect('admin/index');
        }

        $countries = Country::whereStatus(true)->get(['id','name']);
        return view('backend.customer_addresses.edit',compact('countries','customer_address'));

    }



    public function update(CustomerAddressRequest $request,UserAddress $customer_address)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_customer_addresses')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {
            $customer_address->update($request->validated());
            DB::commit();
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }
        Session::flash('message', trans('customers.customer update success'));
        Session::flash('type', trans('customers.updated Successfully'));
        Session::flash('alert-type', 'success');
        return redirect()->route('admin.customer_addresses.index');

    }

    public function destroy($id)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'delete_customer_addresses')) {
            return redirect('admin/index');
        }

        $deletedis = UserAddress::findOrFail($id)->delete();

        return response()->json(array("exists" => true));
    }

    public function get_cities(Request $request)
    {
        $cities = City::whereStateId($request->state_id)->whereStatus(true)->get(['id', 'name'])->toArray();
        return response()->json($cities);
    }
    public function get_states(Request $request)
    {
        $states = State::whereCountryId($request->country_id)->whereStatus(true)->get(['id', 'name'])->toArray();
        return response()->json($states);
    }
}
