<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductReviewRequest;
use App\Models\Backend\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductReviewController extends Controller
{
    public function index()
    {
        //permissions user access
        if (!auth()->user()->ability('admin', 'manage_product_reviews,show_product_reviews')) {
            return redirect('admin/index');
        }


        $reviews = ProductReview::query()
            ->when(\request()->keywords != null, function ($query) {
                $query->search(\request()->keywords);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        $reviewsCounts = ProductReview::all()->count();

        return view('backend.product_review.index', compact('reviews','reviewsCounts'));
    }


    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_product_reviews')) {
            return redirect('admin/index');
        }

//        return view('backend.product_review.create');

    }


    public function store(Request $request)
    {
        if (!auth()->user()->ability('admin', 'create_product_reviews')) {
            return redirect('admin/index');
        }
        DB::beginTransaction();
        try {


            DB::commit();
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()])->withInput();
            DB::rollBack();

        }


    }

    public function show(ProductReviewRequest $productReviews)
    {

        return view('backend.product_review.edit', compact('productReviews'));

    }

    public function edit(ProductReviewRequest $productReview)
    {

        if (!auth()->user()->ability('admin', 'update_product_reviews')) {
            return redirect('admin/index');
        }
        return view('backend.product_review.edit',compact('productReview'));

    }


    public function update(ProductReviewRequest $request, ProductReview $productReview)
    {
        if (!auth()->user()->ability('admin', 'update_product_reviews')) {
            return redirect('admin/index');
        }

        DB::beginTransaction();
        try {
            $productReview->update($request->validated());

            DB::commit();
            Session::flash('message', trans('coupons.coupon add success'));
            Session::flash('type', trans('coupons.Add Successfully'));
            Session::flash('alert-type', 'success');
            return redirect()->route('admin.product_reviews.index');

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

        $reviews = ProductReview::findOrFail($id);


        $reviews->delete();

        return response()->json(array("exists" => true));


    }


}
