<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCategoriesRequest;
use App\Http\Requests\Backend\ProductCategoryRequest;
use App\Models\Backend\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
class ProductCategoriesController extends Controller
{

    public function index()
    {

        //permissions user access
        if (!auth()->user()->ability('admin', 'manage_product_categories,show_product_categories')) {
            return redirect('admin/index');
        }


        $categories = ProductCategories::withCount('products')
            ->when(\request()->keywords != null, function ($query) {
                $query->search(\request()->keywords);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        $main_categories = ProductCategories::whereNull('parent_id')->get(['id', 'name']);


        return view('backend.categories.index', compact('categories', 'main_categories'));
    }


    public function create()
    {
        return view('backend.categories.create');

    }


    public function store(ProductCategoriesRequest $request)
    {

        //permissions user access
        if (!auth()->user()->ability('admin','create_product_categories')) {
            return redirect('admin/index');
        }

        $validated = $request->validated();

        $today = date('Ymd');
        $productsNumber = ProductCategories::where('slug','like', $today.'%')->pluck('slug');
        do{
            $productNumber = $today . rand(100000,999999);
        }while ($productsNumber->contains($productNumber));

        DB::beginTransaction();
        try {

            $input['name'] = ['ar'=>$request->name['ar'],'en'=>$request->name['en']];
            $input['slug'] = $productNumber;
            $input['status'] = $request->status;
            $input['parent_id'] = $request->parent_id ? $request->parent_id : null;

            if ($request->file('cover')) {
                $imagefile = $request->file('cover');
                $name = $request->name['en'];
                $ex = $imagefile->getClientOriginalExtension();
                $path = $imagefile->storeAs('categories/'.$request->name['en'], $name . '.' . $ex, ['disk' => 'uploads']);
                $input['cover'] = $path;
            }
            $input['created_by'] = Auth::id();

            ProductCategories::create($input);
            DB::commit();



            Session::flash('message', trans('categories.category add success'));
            Session::flash('type', trans('categories.Add Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.product_categories.index');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
        }



    }


    public function show($id)
    {
        return view('backend.categories.show');

    }


    public function edit($id)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_product_categories')) {
            return redirect('admin/index');
        }


    }

    public function getCategory($id)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_product_categories')) {
            return redirect('admin/index');
        }
        $types = ProductCategories::findOrFail($id);
        return response()->json($types);
    }


    public function update(ProductCategoriesRequest $request, ProductCategories $category)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'update_product_categories')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {
            $cover = ProductCategories::whereId($request->id)->first();
            $user = $request->id;
            $input['name'] = ['ar'=>$request->name['ar'],'en'=>$request->name['en']];
            $input['status'] = $request->status;
            $input['parent_id'] = $request->parent_id ? $request->parent_id : null;


            $image = $category->cover;
            if ($request->file('cover')) {
                Storage::delete('uploads/'.$image);
                $imagefile = $request->file('cover');
                $name = $request->name['en'];
                $ex = $imagefile->getClientOriginalExtension();
                $path = $imagefile->storeAs('categories/'.$request->name['en'], $name . '.' . $ex, ['disk' => 'uploads']);
            }else{
                $path = $cover->cover;
            }
            $input['cover'] = $path;
            $input['updated_by'] = Auth::id();

            $update = ProductCategories::findOrFail($request->id);
            $update->update($input);


            DB::commit();

            Session::flash('message', trans('categories.category update success'));
            Session::flash('type', trans('categories.update Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.product_categories.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }

    }

    public function destroy($id)
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'delete_product_categories')) {
            return redirect('admin/index');
        }
        $deleted_by = ProductCategories::findOrFail($id);
        $deleted_by->deleted_by = Auth::id();
        $deleted_by->save();

        $deletedis = ProductCategories::findOrFail($id)->delete();

        return response()->json(array("exists" => true));
    }
}
