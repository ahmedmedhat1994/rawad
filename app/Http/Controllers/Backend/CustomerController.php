<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{

    public function index()
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'manage_customers,show_customers')) {
            return redirect('admin/index');
        }


        $customers = User::whereHas('roles',function ($query){

            $query->where('name','customer');
        })
            ->when(\request()->keywords != null, function ($query) {
                $query->search(\request()->keywords);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        $customerCount = User::whereHas('roles',function ($query){
            $query->where('name','customer');
        })->count();

        return view('backend.customer.index', compact('customers','customerCount'));
    }


    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_customers')) {
            return redirect('admin/index');
        }

        return view('backend.customer.create');

    }


    public function store(CustomerRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_customers')) {
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['email'] = $request->email;
        $input['password'] = bcrypt($request->password);
        $input['username'] = $request->username;
        $input['mobile'] = $request->mobile;
        $input['status'] = $request->status;
        $input['email_verified_at'] = now();
//


        if ($request->file('photo')) {
            $imagefile = $request->file('photo');
            $path = $imagefile->store('/users/' . $request->username, ['disk' => 'uploads']);
            $input['photo'] = $path;
        }

        $customer = User::create($input);
        $customer->attachRole(Role::whereName('customer')->first()->id);



        Session::flash('message', trans('customers.customer add success'));
        Session::flash('type', trans('customers.Add Successfully'));
        Session::flash('alert-type', 'success');
        return redirect()->route('admin.customers.index');


    }

    public function show()
    {

        return view('backend.customer.edit');

    }

    public function edit(User $customer)
    {

        if (!auth()->user()->ability('admin', 'update_customers')) {
            return redirect('admin/index');
        }
        return view('backend.customer.edit',compact('customer'));

    }


    public function update(CustomerRequest $request, User $customer)
    {


        if (!auth()->user()->ability('admin', 'update_customers')) {
            return redirect('admin/index');
        }

        DB::beginTransaction();
        try {



            $update = User::findOrFail($request->id);

            $update->first_name = $request->first_name;
            $update->last_name = $request->last_name;
            $update->email = $request->email;

            if (trim($request->password)!= ''){
                $update->password = $request->password;
            }
            $update->username = $request->username;
            $update->mobile = $request->mobile;
            $update->status = $request->status;
            if ($request->file('photo')) {

                if ($customer->photo != null && File::exists('uploads/'.$customer->photo)){
                    unlink('uploads/'.$customer->photo);
                }
                $imagefile = $request->file('photo');
                $path = $imagefile->store('/users/' . $request->username, ['disk' => 'uploads']);
                $update->photo = $path;

            }
            $update->save();
            DB::commit();

            Session::flash('message', trans('customers.customer update success'));
            Session::flash('type', trans('customers.update Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.customers.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }





    }


    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_customers')) {
            return redirect('admin/index');
        }

        $customer = User::findOrFail($id);
        if ($customer->user_image != null && File::exists('uploads/users/'.$customer->user_image)){
            unlink('uploads/users/'.$customer->user_image);
        }
        $customer->delete();

        return response()->json(array("exists" => true));


    }

    public function get_customers(Request $request)
    {
        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })
            ->when(\request()->input('query') != '', function ($query) {
                $query->search(\request()->input('query'));
            })
            ->get(['id','first_name','last_name','email'])->toArray();

//        $query = $request->get('query');
//        $filterResult = User::whereHas('roles', function ($query) {
//           $query->where('name', 'customer');
//      })->where('username', 'LIKE', '%'. $query. '%')->get(['id','first_name','last_name','email']);

        return response()->json($customers);
    }

}
