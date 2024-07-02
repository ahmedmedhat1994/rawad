<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class SupervisorController extends Controller
{
    public function index()
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'manage_supervisors,show_supervisors')) {
            return redirect('admin/index');
        }


        $supervisors = User::whereHas('roles',function ($query){

            $query->where('name','supervisor');
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
            $query->where('name','supervisor');
        })->count();

        return view('backend.supervisor.index', compact('supervisors','customerCount'));
    }


    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_supervisors')) {
            return redirect('admin/index');
        }
        $permissions = Permission::tree();
        $permissionIs = Permission::all();
        return view('backend.supervisor.create',compact('permissions','permissionIs'));

    }


    public function store(SupervisorRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_supervisors')) {
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
        if ($image = $request->file('photo')) {
            $type = $request->photo->getClientOriginalExtension();
            $name = $request->username . '.' . $type;
            $image->storeAs('users/'.$request->username, $name, 'uploads');
            $input['photo'] =$name;
        }

        $supervisor = User::create($input);

        $supervisor->attachRole(Role::whereName('supervisor')->first()->id);


        //add Permissions
        if (isset($request->permissions) && count($request->permissions) > 0){

            $arrayIs = explode(',',$request->permissions[0]);

            $supervisor->permissions()->sync($arrayIs);
        }


        Session::flash('message', trans('supervisors.supervisor add success'));
        Session::flash('type', trans('supervisors.Add Successfully'));
        Session::flash('alert-type', 'success');
        return redirect()->route('admin.supervisors.index');



    }

    public function show()
    {

        return view('backend.supervisor.edit');

    }

    public function edit(User $supervisor)
    {

        if (!auth()->user()->ability('admin', 'update_supervisors')) {
            return redirect('admin/index');
        }

        $permissions = Permission::get(['id','display_name']);
        $userPermissions=UserPermissions::whereUserId($supervisor->id)->pluck('permission_id')->toArray();

        return view('backend.supervisor.edit',compact('supervisor','permissions','userPermissions'));

    }


    public function update(SupervisorRequest $request, User $supervisor)
    {
        if (!auth()->user()->ability('admin', 'update_supervisors')) {
            return redirect('admin/index');
        }

        DB::beginTransaction();
        try {

            $input['first_name'] = $request->first_name;
            $input['last_name'] = $request->last_name;
            $input['email'] = $request->email;
            if (trim($request->password)!= ''){
                $input['password'] = bcrypt($request->password);
            }
            $input['username'] = $request->username;
            $input['mobile'] = $request->mobile;
            $input['status'] = $request->status;
//
            if ($image = $request->file('user_image')) {
                if ($supervisor->user_image != null && File::exists('assets/users/'.$supervisor->user_image)){
                    unlink('assets/users/'.$supervisor->user_image);
                }
                $type = $request->user_image->getClientOriginalExtension();
                $name = $request->username . '.' . $type;
                $image->storeAs('users/', $name, 'store');
                $input['user_image'] =$name;
            }


            $supervisor->update($input);
            //add Permissions
            if (isset($request->permissions) && count($request->permissions) > 0){

                $supervisor->permissions()->sync($request->permissions);
            }

            DB::commit();
            Session::flash('message', trans('supervisors.supervisor update success'));
            Session::flash('type', trans('supervisors.update Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.supervisors.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }


    }


    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_supervisors')) {
            return redirect('admin/index');
        }

        $supervisor = User::findOrFail($id);
        if ($supervisor->photo != null && File::exists('assets/users/'.$supervisor->user_image)){
            unlink('assets/users/'.$supervisor->username.'/'.$supervisor->user_image);
        }
        $supervisor->delete();

        return response()->json(array("exists" => true));


    }
}
