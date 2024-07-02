<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TagRequest;
use App\Models\Backend\ProductCategories;
use App\Models\Backend\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{

    public function index()
    {

        //permissions user access
        if (!auth()->user()->ability('admin', 'manage_tags,show_tags')) {
            return redirect('admin/index');
        }


        $tags = Tags::withCount('products')
            ->when(\request()->keywords != null, function ($query) {
                $query->search(\request()->keywords);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.tags.index', compact('tags'));
    }


    public function create()
    {
        return view('backend.tags.create');

    }


    public function store(TagRequest $request)
    {

        $today = date('Ymd');
        $productsNumber = Tags::where('slug','like', $today.'%')->pluck('slug');
        do{
            $productNumber = $today . rand(100000,999999);
        }while ($productsNumber->contains($productNumber));

        //permissions user access
        if (!auth()->user()->ability('admin','create_tags')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {
            $input['name'] = ['ar'=>$request->name['ar'],'en'=>$request->name['en']];
            $input['slug'] = $productNumber;
            $input['status'] = $request->status;

            Tags::create($input);
            DB::commit();

            Session::flash('message', trans('tags.category add success'));
            Session::flash('type', trans('tags.Add Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.tags.index');

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }



    }


    public function show($id)
    {
        return view('backend.tags.show');

    }


    public function edit($id)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_tags')) {
            return redirect('admin/index');
        }

    }

    public function getTag($id)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_tags')) {
            return redirect('admin/index');
        }
        $tag = Tags::findOrFail($id);
        return response()->json($tag);
    }


    public function update(TagRequest $request)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_tags')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {
            $input['name'] = $request->name;
            $input['status'] = $request->status;

            $update = Tags::findOrFail($request->id);
            $update->update($input);

            DB::commit();

            Session::flash('message', trans('tags.tag update success'));
            Session::flash('type', trans('tags.update Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.tags.index');


        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }

    }

    public function destroy($id)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'delete_tags')) {
            return redirect('admin/index');
        }
//        $deleted_by = Tags::findOrFail($id);
//        $deleted_by->deleted_by = Auth::id();
//        $deleted_by->save();

        $deletedis = Tags::findOrFail($id)->delete();

        return response()->json(array("exists" => true));
    }



}
