<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShippingCompanyRequest;
use App\Models\Backend\Country;
use App\Models\Backend\ShippingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ShippingCompanyController extends Controller
{
    public function index()
    {
        if (!Auth::user()->ability('admin', 'manage_shipping_companies,show_shipping_companies')){
            return redirect('admin/index');
        }

        $shipping_companies = ShippingCompany::withCount('countries')
            ->when(\request()->keyword != '', function ($q){
                $q->search(\request()->keyword);
            })
            ->when(\request()->status != '', function ($q){
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        $totalCompaines=ShippingCompany::all()->count();
        $countries = Country::orderBy('id', 'asc')->get(['id', 'name']);

        return view('backend.shipping_companies.index', compact('shipping_companies','totalCompaines','countries'));
    }

    public function create()
    {
        if (!Auth::user()->ability('admin', 'create_shipping_companies')){
            return redirect('admin/index');
        }
    }

    public function store(ShippingCompanyRequest $request)
    {
        if (!Auth::user()->ability('admin', 'create_shipping_companies')){
            return redirect('admin/index');
        }

        if ($request->validated()) {
            $shipping_company = ShippingCompany::create($request->except('countries', '_token', 'submit'));
            $shipping_company->countries()->attach(array_values($request->countries));

            Session::flash('message', trans('shipping.company add success'));
            Session::flash('type', trans('shipping.Add Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.shipping_companies.index');

        } else {
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Something wrong',
                'alert-type' => 'danger'
            ]);
        }
    }

    public function edit(ShippingCompany $shipping_company)
    {
        if (!Auth::user()->ability('admin', 'update_shipping_companies')){
            return redirect('admin/index');
        }

    }

    public function update(ShippingCompanyRequest $request, ShippingCompany $shipping_company)
    {
        if (!Auth::user()->ability('admin', 'update_shipping_companies')){
            return redirect('admin/index');
        }


        if ($request->validated()) {

            $shipping_company->update($request->except('countries', '_token', 'submit'));
            $shipping_company->countries()->sync(array_values($request->countries));

            Session::flash('message', trans('shipping.company updated success'));
            Session::flash('type', trans('shipping.updated Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.shipping_companies.index');

        } else {
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Something wrong',
                'alert-type' => 'danger'
            ]);
        }
    }
    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_shipping_companies')) {
            return redirect('admin/index');
        }

        $ShippingCompany = ShippingCompany::findOrFail($id);
        $ShippingCompany->delete();

        return response()->json(array("exists" => true));


    }

}
