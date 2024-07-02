<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\productRequest;
use App\Http\Requests\Backend\ProductsRequest;
use App\Models\Backend\Media;
use App\Models\Backend\ProductCategories;
use App\Models\Backend\Products;
use App\Models\Backend\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{

    public function index()
    {
        //permissions user access
                if (!auth()->user()->ability('admin', 'manage_products,show_products')) {
                    return redirect('admin/index');
                }


                $products = Products::with('category','tags','firstMedia')
                    ->when(\request()->keywords != null, function ($query) {
                        $query->search(\request()->keywords);
                    })
                    ->when(\request()->status != null, function ($query) {
                        $query->whereStatus(\request()->status);
                    })
                    ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
                    ->paginate(\request()->limit_by ?? 10);
                return view('backend.products.index', compact('products'));
    }


    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_products')) {
            return redirect('admin/index');
        }
        $categories = ProductCategories::whereStatus(1)->get(['id','name']);
        $tags = Tags::whereStatus(1)->get(['id','name']);

        return view('backend.products.create',compact('categories','tags'));

    }
    public function upload_images(Request $request)
    {
        if (!auth()->user()->ability('admin', 'create_products')) {
            return redirect('admin/index');
        }
        $path = public_path('uploads/products');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function delete_image($id)
    {
        if (!auth()->user()->ability('admin', 'create_products')) {
            return redirect('admin/index');
        }
//        $validate = Media::where('filename',$id)->first();
//
//        if (isset($validate) && $validate != null)
//        {
//            Media::where('filename',$id)->first()->delete();
//            File::delete(public_path('uploads/products/'.$id));//deleting directory using the storage facade
//
//        }else{
//
//
//        }
        File::delete(public_path('uploads/products/'.$id));//deleting directory using the storage facade


        return response()->json([
            'message'          => $id,

        ]);
    }

    public function readFiles()
    {
        if (!auth()->user()->ability('admin', 'create_products')) {
            return redirect('admin/index');
        }
        $directory = 'uploads/products';
        $files_info = [];
        $file_ext = array('png','jpg','jpeg','pdf');

        // Read files
        foreach (File::allFiles(public_path($directory)) as $file) {
            $extension = strtolower($file->getExtension());

            if(in_array($extension,$file_ext)){ // Check file extension
                $filename = $file->getFilename();
                $size = $file->getSize(); // Bytes
                $sizeinMB = round($size / (1000 * 1024), 2);// MB

                if($sizeinMB <= 2){ // Check file size is <= 2 MB
                    $files_info[] = array(
                        "name" => $filename,
                        "size" => $size,
                        "path" => url($directory.'/'.$filename)
                    );
                }
            }
        }
        return response()->json($files_info);
    }
    public function store(ProductsRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_products')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {

            $today = date('Ymd');
            $productsNumber = Products::where('slug','like', $today.'%')->pluck('slug');
            do{
                $productNumber = $today . rand(100000,999999);
            }while ($productsNumber->contains($productNumber));

            $input['name'] = ['ar'=>$request->name['ar'],'en'=>$request->name['en']];
            $input['description'] = $request->description;
            $input['slug'] = $productNumber;
            $input['price'] = $request->price;
            $input['quantity'] = $request->quantity;
            $input['product_category_id'] = $request->product_category_id;
            $input['featured'] = $request->featured;
            $input['status'] = $request->status;
            $input['sale_price'] = $request->sale_price;

            $product=Products::create($input);



            $product->tags()->attach($request->tags);

            foreach ($request->input('productColor', []) as $color) {
                $product->colors()->create(["color" => $color]);

            }

            foreach ($request->input('size', []) as $size) {
                $product->sizes()->create(["size" => $size]);
            }


            $files = $request->input('document', []);

            foreach ($request->input('document', []) as $file) {


                    $fileUid = asset('uploads/products'.$file);
                    $media = Media::create([
                        'filename' => $file,
                        'uid' => $fileUid,
                        'size' => '5',
                        'mime' => 'jpg',
                        'attachable_id' => $product->id,
                        'attachable_type' => 'App/Models/Backend/products',
                    ]);
            }




            DB::commit();

            Session::flash('message', trans('products.category add success'));
            Session::flash('type', trans('products.Add Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.products.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }



    }



    public function edit($id)
    {

        if (!auth()->user()->ability('admin', 'update_products')) {
            return redirect('admin/index');
        }
        $product=Products::findOrFail($id);
        $categories = ProductCategories::whereStatus(1)->get(['id','name']);
        $tags = Tags::whereStatus(1)->get(['id','name']);
        return view('backend.products.edit',compact('categories','tags','product'));


    }


    public function update(ProductsRequest $request)
    {
        if (!auth()->user()->ability('admin', 'update_products')) {
            return redirect('admin/index');
        }

        DB::beginTransaction();
        try {

            $input['name'] = ['ar'=>$request->name['ar'],'en'=>$request->name['en']];
            $input['description'] = $request->description;
            $input['price'] = $request->price;
            $input['quantity'] = $request->quantity;
            $input['product_category_id'] = $request->product_category_id;
            $input['featured'] = $request->featured;
            $input['status'] = $request->status;
            $input['sale_price'] = $request->sale_price;

            $product =Products::findOrFail($request->id);

            $product->update($input);

            $product->tags()->sync($request->tags);


            if ($product->colors->count() > 0) {
                foreach ($product->colors as $color) {
                    if (!in_array($color->color, $request->input('productColor', []))) {
                        $color->delete();

                    }
                }

            }
            $color = $product->colors->pluck('color')->toArray();

            foreach ($request->input('productColor', []) as $file) {
                if (count($color) === 0 || !in_array($file, $color)) {
                    $product->colors()->create(["color" => $file]);
                }
            }




            if ($product->sizes->count() > 0) {
                foreach ($product->sizes as $size) {
                    if (!in_array($size->size, $request->input('size', []))) {
                        $size->delete();

                    }
                }

            }
            $size = $product->sizes->pluck('size')->toArray();

            foreach ($request->input('size', []) as $file) {
                if (count($color) === 0 || !in_array($file, $size)) {
                    $product->sizes()->create(["size" => $file]);
                }
            }



            if ($product->attachments->count() > 0) {
                foreach ($product->attachments as $media) {
                    if (!in_array($media->filename, $request->input('document', []))) {
                        File::delete(public_path('uploads/products/'.$media->filename));//deleting directory using the storage facade
                        $media->delete();

                    }
                }
            }

            $media = $product->attachments->pluck('filename')->toArray();

            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $fileUid = asset('uploads/products'.$request->id.'/'.$file);
                    Media::create([
                        'filename' => $file,
                        'uid' => $fileUid,
                        'size' => '5',
                        'mime' => 'jpg',
                        'attachable_id' => $request->id,
                        'attachable_type' => 'App/Models/Backend/products',
                    ]);
                }
            }









            DB::commit();

            Session::flash('message', trans('products.category add success'));
            Session::flash('type', trans('products.Add Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.products.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }



    }


    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_products')) {
            return redirect('admin/index');
        }

        $product = Products::findOrFail($id);


        if ($product->colors->count() > 0) {
            foreach ($product->colors as $color) {
                $color->delete();
            }

        }


        if ($product->sizes->count() > 0) {
            foreach ($product->sizes as $size) {
                $size->delete();
            }

        }


        if ($product->attachments()->count() > 0){

            foreach ($product->attachments as $media){

                if (File::exists('uploads/products/'. $media->filename)){

                    unlink('uploads/products/'. $media->filename);
                }
                $media->delete();
            }

            $product->delete();

            return response()->json(array("exists" => true));


        }



    }

}
