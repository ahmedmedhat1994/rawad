@extends('Frontend.layout2.master')
@section('title')
    {{$product->name}}
@endsection

@section('style')

@endsection

@section('content')
    <div class="page-header breadcrumb-wrap" dir="rtl">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('frontend.index')}}" rel="nofollow">{{trans('frontend.home')}}</a>
                <span></span> <a href="{{route('frontend.shop')}}" rel="nofollow">{{trans('frontend.shop')}}</a>
                <span></span> <a href="{{route('frontend.shop',$product->category->slug)}}"
                                 rel="nofollow">{{$product->category->name}}</a>
                <span></span> {{$product->name}}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-12 col-xs-12" style="direction: rtl !important;">
                                <div class="detail-info">
                                    <h2 class="title-detail">{{$product->name}}</h2>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> القسم: <a
                                                        href="shop-grid-right.html">{{$product->category->name}}</a></span>
                                        </div>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (25 reviews)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover" style="direction: rtl !important;">
                                        <div class="product-price primary-color float-right">
                                            @if(isset($product->sale_price))
                                                <ins><span class="text-brand orig-price"
                                                           id="price{{$product->id}}">{{$product->sale_price}}</span>ر.س
                                                </ins>
                                                <ins><span class="old-price font-md ml-15">{{$product->price}}ر.س</span>
                                                </ins>
                                            @else
                                                <ins><span class="text-brand orig-price"
                                                           id="price{{$product->id}}">{{$product->price}}</span>ر.س
                                                </ins>

                                            @endif
                                            <span class="save-price  font-md color3 ml-15">{{$product->sale_price / $product->price * (100) }} % خصم</span>
                                        </div>
                                        <div class="product-price primary-color float-right">
                                            <ins>
                                                <i class="fa-solid fa-fire fa-beat-fade fa-sm"
                                                   style="color: #ff0000;"></i>
                                                @php
                                                    $rand =rand('111','222');
                                                @endphp
                                                <span class="fs-6">تم شراءه <span class="text-danger">{{$rand}}</span> مرة</span>
                                            </ins>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>

                                    <div class="product_sort_info font-xs mb-30" style="direction: rtl !important;">
                                        <ul>
                                            <li class="mb-10">
                                                <div class="position-relative border border-dark rounded p-3 row tammaraModal"
                                                     style="cursor:pointer !important;">
                                                    <div class="col-8">
                                                        <a class="fw-bold" style="font-size:14px !important;">4 دفعات
                                                            بقيمة <span
                                                                    class="text-danger installment-price">122.00</span>
                                                            ر.س ./شهر - متوافقة مع الشريعة، وبدون رسوم تأخير! <span
                                                                    class="text-danger">اعرف اكتر</span></a>
                                                    </div>
                                                    <div class="col-4">
                                                        <img class="float-start" style="width: 100px !important;"
                                                             src="{{asset('frontend/imgs/tammara.svg')}}" alt="">
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="mb-10">
                                                <div class="position-relative border border-dark rounded p-3 row tabbyModal"
                                                     style="cursor:pointer !important;">
                                                    <div class="col-8">
                                                        <a class="fw-bold" style="font-size:14px !important;">4 دفعات
                                                            بلا فوائد بقيمة <span class="text-danger installment-price"
                                                                                  id="installment-price">122.00</span>
                                                            ر.س ./شهر -بدون رسوم، ومتوافقة مع أحكام الشريعة.! <span
                                                                    class="text-danger">اعرف اكتر</span></a>
                                                    </div>
                                                    <div class="col-4">
                                                        <img class="float-start" style="width: 100px !important;"
                                                             src="{{asset('frontend/imgs/tabby.png')}}" alt="">
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                    @if(isset($product->colors))
                                        <div class="attr-detail attr-color mb-15">
                                            <strong class="ml-10">الالوان</strong>
                                            <ul class="list-filter color-filter">
                                                @foreach($product->colors as $color)
                                                    <li><a href="javascript:void(0)"
                                                           data-color="{{$color->color}}"><span
                                                                    style="background-color:{{$color->color}}; "></span></a>
                                                    </li>
                                                @endforeach

                                                <input type="hidden" name="color" value="" id="color_id">

                                                <input type="hidden" name="id" value="{{$product->id}}" id="product_id">

                                            </ul>
                                        </div>
                                    @endif
                                    @if(isset($product->sizes))
                                        <div class="attr-detail attr-size">
                                            <strong class="ml-10">المقاسات</strong>
                                            <ul class="list-filter size-filter font-small">
                                                @foreach($product->sizes as $size)
                                                    <li><a href="#">{{$size->size}}</a></li>
                                                @endforeach
                                                <input type="hidden" name="size" value="" id="size_id">

                                            </ul>
                                        </div>
                                    @endif
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <table class="table shopping-summery text-center clean ">
                                        <tbody>
                                        <tr>
                                            <th scope="row">السعر</th>
                                            <td colspan="2"></td>
                                            <th colspan="2"><span class="price-value"
                                                                  id="price-value{{$product->id}}">{{$product->sale_price}}</span>ر.س
                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="align-items-center align-content-center">الكمية</th>
                                            <td colspan="2"></td>
                                            <td>
                                                <div class="border radius row d-flex align-content-center align-items-center quantity">
                                                    <button href="#" class="btn btn-primary qty-down col-4"><i
                                                                class="fa-solid fa-minus"></i></button>
                                                    <input value="1" class="qty-val col-4 text-center"></input>
                                                    <button href="#" class="btn btn-primary qty-up col-4"><i
                                                                class="fa-solid fa-plus"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <div class="detail-extralink row">
                                        <div class="col-6 align-content-center align-items-center text-center">
                                            <a class="button button-add-to-cart d-flex align-content-center align-items-center text-center"
                                               style="color: #fff" onclick="addToCart({{$product->id}})"><img
                                                        class="m-2" style="width:20px;"
                                                        src="{{asset('frontend/imgs/shopping-bag.svg')}}">{{trans('frontend.Add to cart')}}
                                            </a>
                                        </div>
                                        <div class="col-6 align-content-center align-items-center text-center">
                                            <a class="button button-add-to-cart d-flex align-content-center align-items-center text-center p-3"
                                               style="color: #fff" onclick="addToWishlist({{$product->id}})"><i
                                                        class="fi-rs-heart"
                                                        style="width:20px;"></i>{{trans('frontend.Add To Wishlist')}}
                                            </a>
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">العلامات:
                                            @foreach($product->tags as $tag)
                                                <a href="#" rel="tag">{{$tag->name}}</a>,
                                            @endforeach
                                        </li>
                                        <li>الكمية المتاحة : <span class="in-stock text-success ml-5">{{$product->quantity}} قطعة فى المخزن </span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Detail Info -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        @foreach($product->attachments as $media)
                                            <figure class="border-radius-10">
                                                <img src="{{asset('uploads/products/'.$media->filename)}}"
                                                     alt="product image">
                                            </figure>
                                        @endforeach
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @foreach($product->attachments as $media)
                                            <div><img src="{{asset('uploads/products/'.$media->filename)}}"
                                                      alt="product image"></div>
                                        @endforeach

                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>

                        </div>
                        <div class="row" dir="rtl">
                            <div class="col-lg-10 m-auto entry-main-content">
                                <h2 class="section-title style-1 mb-30">تفاصيل المنتج</h2>
                                <div class="description mb-50">
                                    {!! $product->description !!}
                                </div>
                                <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block" dir="rtl">
                                        <li class="social-facebook"><a href="#"><img
                                                        src="{{asset('frontend/imgs/theme/icons/icon-facebook.svg')}}"
                                                        alt=""></a></li>
                                        <li class="social-twitter"><a href="#"><img
                                                        src="{{asset('frontend/imgs/theme/icons/icon-twitter.svg')}}"
                                                        alt=""></a></li>
                                        <li class="social-instagram"><a href="#"><img
                                                        src="{{asset('frontend/imgs/theme/icons/icon-instagram.svg')}}"
                                                        alt=""></a></li>
                                        <li class="social-linkedin"><a href="#"><img
                                                        src="{{asset('frontend/imgs/theme/icons/icon-pinterest.svg')}}"
                                                        alt=""></a></li>
                                        <li><strong class="mr-10">شارك المنتج:</strong></li>

                                    </ul>
                                </div>
                                <h3 class="section-title style-1 mb-30 mt-30">تقييمات المنتج
                                    ( {{$product->reviews->count()}} )</h3>
                                <!--Comments-->
                                <div class="comments-area style-2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="comment-list">
                                                @foreach($product->reviews as $review)
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{asset('frontend/imgs/page/avatar-6.jpg')}}"
                                                                     alt="">
                                                                <h6><a href="#">{{$review->name}}</a></h6>
                                                                <p class="font-xxs">{{$review->createdSince()}}</p>
                                                            </div>
                                                            <div class="desc" style="padding-right: 20px;">
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating"
                                                                         style="width:{{$review->rating*10*2}}%">

                                                                    </div>
                                                                </div>
                                                                <p>{{$review->title}}</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--single-comment -->
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--comment form-->

                                {{--                                <div class="comment-form">--}}
                                {{--                                    <h4 class="mb-15">Add a review</h4>--}}
                                {{--                                    <div class="product-rate d-inline-block mb-30">--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="row">--}}
                                {{--                                        <div class="col-lg-8 col-md-12">--}}
                                {{--                                            <form class="form-contact comment_form" action="#" id="commentForm">--}}
                                {{--                                                <div class="row">--}}
                                {{--                                                    <div class="col-12">--}}
                                {{--                                                        <div class="form-group">--}}
                                {{--                                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>--}}
                                {{--                                                        </div>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <div class="col-sm-6">--}}
                                {{--                                                        <div class="form-group">--}}
                                {{--                                                            <input class="form-control" name="name" id="name" type="text" placeholder="Name">--}}
                                {{--                                                        </div>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <div class="col-sm-6">--}}
                                {{--                                                        <div class="form-group">--}}
                                {{--                                                            <input class="form-control" name="email" id="email" type="email" placeholder="Email">--}}
                                {{--                                                        </div>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <div class="col-12">--}}
                                {{--                                                        <div class="form-group">--}}
                                {{--                                                            <input class="form-control" name="website" id="website" type="text" placeholder="Website">--}}
                                {{--                                                        </div>--}}
                                {{--                                                    </div>--}}
                                {{--                                                </div>--}}
                                {{--                                                <div class="form-group">--}}
                                {{--                                                    <button type="submit" class="button button-contactForm">Submit--}}
                                {{--                                                        Review</button>--}}
                                {{--                                                </div>--}}
                                {{--                                            </form>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                        <div class="row mt-60" style="direction: rtl;">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">منتجات قد تعجبك</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    @foreach($relatedProducts as $related)
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{route('frontend.product',$related->slug)}}"
                                                           tabindex="0">
                                                            <img class="default-img"
                                                                 src="{{asset('uploads/products/'.$related->firstMedia->filename)}}"
                                                                 alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="{{trans('frontend.Quick view')}}"
                                                           class="action-btn small hover-up" data-bs-toggle="modal"
                                                           data-bs-target="#quickViewModal{{$related->id}}"><i
                                                                    class="fi-rs-search"></i></a>
                                                        <a aria-label="{{trans('frontend.Add To Wishlist')}}"
                                                           class="action-btn small hover-up"
                                                           onclick="addToWishlist({{$related->id}})"
                                                           href="javascript:void(0)" tabindex="0"><i
                                                                    class="fi-rs-heart"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">{{$related->category->name}}</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="javascript:void(0)"
                                                           tabindex="0">{{$related-> name}}</a></h2>
                                                    <div class="rating-result" title="90%">
                                                        <span>
                                                        </span>
                                                    </div>
                                                    <div class="product-price">
                                                        @if(isset($related->sale_price))
                                                            <span>{{$related->sale_price}} ر.س </span>
                                                            <span class="old-price">{{$related->price}} ر.س </span>
                                                        @else
                                                            <span>{{$related->price}} ر.س </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- tammara modal--}}
    <div class="modal fade custom-modal" id="tammaraModal" tabindex="-1" aria-labelledby="tammaraModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="tamara-popup__content tamara-animation-zoom-in tamara-animation-zoom-in-enter">
                            <style> .tamara-popup svg {
                                    fill: none !important;
                                    stroke: none !important;
                                }

                                .tamara-popup__icon,
                                .tamara-popup__icon svg {
                                    width: 40px !important;
                                    height: 40px !important;
                                }

                                .tamara-popup__payment-method-note,
                                .tamara-popup__why-item,
                                .tamara-popup__learn-button,
                                .tamara-popup__footer {
                                    font-family: 'Helvetica Neue', 'sans-serif';
                                }

                                [dir='rtl'] .tamara-popup__payment-method-note,
                                [dir='rtl'] .tamara-popup__why-item,
                                [dir='rtl'] .tamara-popup__learn-button,
                                [dir='rtl'] .tamara-popup__footer {
                                    font-family: 'Noto Sans Arabic', 'sans-serif';
                                }

                                .tamara-popup__moto,
                                .tamara-popup__point-title,
                                .tamara-popup__why-title {
                                    font-family: 'Space Grotesk', 'sans-serif';
                                }

                                [dir='rtl'] .tamara-popup__moto,
                                [dir='rtl'] .tamara-popup__point-title,
                                [dir='rtl'] .tamara-popup__why-title {
                                    font-family: 'IBM Plex Sans Arabic', 'sans-serif';
                                }

                                .tamara-popup p {
                                    display: block;
                                    margin-block-start: 0;
                                    margin-block-end: 0;
                                    margin-inline-start: 0px;
                                    margin-inline-end: 0px;
                                    letter-spacing: unset;
                                }

                                .space-y-12 > :not(template) ~ :not(template) {
                                    margin-top: 0.75rem !important;
                                }

                                .relative {
                                    position: relative;
                                }

                                .w-full {
                                    width: 100%;
                                }

                                .mt-16 {
                                    margin-top: 16px !important;
                                }

                                .mt-24 {
                                    margin-top: 1.5rem !important;
                                }

                                .tamara-popup {
                                    position: fixed;
                                    left: 0;
                                    top: 0;
                                    bottom: 0;
                                    right: 0;
                                    z-index: 999999;
                                }

                                .tamara-popup ul {
                                    margin: unset;
                                    padding: unset;
                                }

                                .tamara-popup__backdrop {
                                    position: absolute;
                                    left: 0;
                                    top: 0;
                                    bottom: 0;
                                    right: 0;
                                    background: rgba(0, 0, 0, 0.5);
                                }

                                .tamara-popup__close {
                                    color: #666;
                                    position: absolute;
                                    width: 32px;
                                    height: 32px;
                                    right: 24px;
                                    top: 54px;
                                    background: #ffffff;
                                    border-radius: 100%;
                                    cursor: pointer;
                                    z-index: 9999;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                }

                                .tamara-popup__close:hover {
                                    color: #333;
                                    transform: scale(1.1);
                                    transition: transform 300ms linear;
                                }

                                .tamara-popup__inner {
                                    padding: 60px 30px 60px;
                                    background-repeat: no-repeat;
                                    background-size: cover;
                                    background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjY0IiBoZWlnaHQ9IjI3OSIgdmlld0JveD0iMCAwIDY2NCAyNzkiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjY2NCIgaGVpZ2h0PSIxMjAiIGZpbGw9InVybCgjcGFpbnQwX2xpbmVhcl8xMTYzXzU0NzEpIi8+PGcgb3BhY2l0eT0iMC4zIiBmaWx0ZXI9InVybCgjZmlsdGVyMF9mXzExNjNfNTQ3MSkiPjxlbGxpcHNlIGN4PSI1NzYuMzUyIiBjeT0iMSIgcng9IjMzNS41NDEiIHJ5PSI4MSIgZmlsbD0iI0ZGQTE4QSIvPjwvZz48ZyBvcGFjaXR5PSIwLjQiIGZpbHRlcj0idXJsKCNmaWx0ZXIxX2ZfMTE2M181NDcxKSI+PGVsbGlwc2UgY3g9IjEwOC44OTYiIGN5PSIxMzAuNSIgcng9IjE5MC4zNDciIHJ5PSI0OC41IiBmaWxsPSIjREJENUZGIi8+PC9nPjxnIG9wYWNpdHk9IjAuNCIgZmlsdGVyPSJ1cmwoI2ZpbHRlcjJfZl8xMTYzXzU0NzEpIj48ZWxsaXBzZSBjeD0iMzMyIiBjeT0iMTUiIHJ4PSI0MTguNzYzIiByeT0iMTA1IiBmaWxsPSIjRkZGMUQzIi8+PC9nPjxkZWZzPjxmaWx0ZXIgaWQ9ImZpbHRlcjBfZl8xMTYzXzU0NzEiIHg9IjE0MC44MTEiIHk9Ii0xODAiIHdpZHRoPSI4NzEuMDgzIiBoZWlnaHQ9IjM2MiIgZmlsdGVyVW5pdHM9InVzZXJTcGFjZU9uVXNlIiBjb2xvci1pbnRlcnBvbGF0aW9uLWZpbHRlcnM9InNSR0IiPjxmZUZsb29kIGZsb29kLW9wYWNpdHk9IjAiIHJlc3VsdD0iQmFja2dyb3VuZEltYWdlRml4Ii8+PGZlQmxlbmQgbW9kZT0ibm9ybWFsIiBpbj0iU291cmNlR3JhcGhpYyIgaW4yPSJCYWNrZ3JvdW5kSW1hZ2VGaXgiIHJlc3VsdD0ic2hhcGUiLz48ZmVHYXVzc2lhbkJsdXIgc3RkRGV2aWF0aW9uPSI1MCIgcmVzdWx0PSJlZmZlY3QxX2ZvcmVncm91bmRCbHVyXzExNjNfNTQ3MSIvPjwvZmlsdGVyPjxmaWx0ZXIgaWQ9ImZpbHRlcjFfZl8xMTYzXzU0NzEiIHg9Ii0xODEuNDUxIiB5PSItMTgiIHdpZHRoPSI1ODAuNjkzIiBoZWlnaHQ9IjI5NyIgZmlsdGVyVW5pdHM9InVzZXJTcGFjZU9uVXNlIiBjb2xvci1pbnRlcnBvbGF0aW9uLWZpbHRlcnM9InNSR0IiPjxmZUZsb29kIGZsb29kLW9wYWNpdHk9IjAiIHJlc3VsdD0iQmFja2dyb3VuZEltYWdlRml4Ii8+PGZlQmxlbmQgbW9kZT0ibm9ybWFsIiBpbj0iU291cmNlR3JhcGhpYyIgaW4yPSJCYWNrZ3JvdW5kSW1hZ2VGaXgiIHJlc3VsdD0ic2hhcGUiLz48ZmVHYXVzc2lhbkJsdXIgc3RkRGV2aWF0aW9uPSI1MCIgcmVzdWx0PSJlZmZlY3QxX2ZvcmVncm91bmRCbHVyXzExNjNfNTQ3MSIvPjwvZmlsdGVyPjxmaWx0ZXIgaWQ9ImZpbHRlcjJfZl8xMTYzXzU0NzEiIHg9Ii0xODYuNzYzIiB5PSItMTkwIiB3aWR0aD0iMTAzNy41MyIgaGVpZ2h0PSI0MTAiIGZpbHRlclVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY29sb3ItaW50ZXJwb2xhdGlvbi1maWx0ZXJzPSJzUkdCIj48ZmVGbG9vZCBmbG9vZC1vcGFjaXR5PSIwIiByZXN1bHQ9IkJhY2tncm91bmRJbWFnZUZpeCIvPjxmZUJsZW5kIG1vZGU9Im5vcm1hbCIgaW49IlNvdXJjZUdyYXBoaWMiIGluMj0iQmFja2dyb3VuZEltYWdlRml4IiByZXN1bHQ9InNoYXBlIi8+PGZlR2F1c3NpYW5CbHVyIHN0ZERldmlhdGlvbj0iNTAiIHJlc3VsdD0iZWZmZWN0MV9mb3JlZ3JvdW5kQmx1cl8xMTYzXzU0NzEiLz48L2ZpbHRlcj48bGluZWFyR3JhZGllbnQgaWQ9InBhaW50MF9saW5lYXJfMTE2M181NDcxIiB4MT0iMzMyIiB5MT0iMCIgeDI9IjMzMiIgeTI9IjEyMCIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiPjxzdG9wIG9mZnNldD0iMC43MzE0MDEiIHN0b3AtY29sb3I9IndoaXRlIi8+PHN0b3Agb2Zmc2V0PSIwLjgwNDI2NSIgc3RvcC1jb2xvcj0id2hpdGUiIHN0b3Atb3BhY2l0eT0iMC45Ii8+PHN0b3Agb2Zmc2V0PSIwLjg3NjAyNSIgc3RvcC1jb2xvcj0id2hpdGUiIHN0b3Atb3BhY2l0eT0iMC43NSIvPjxzdG9wIG9mZnNldD0iMC45MjU5NTkiIHN0b3AtY29sb3I9IndoaXRlIiBzdG9wLW9wYWNpdHk9IjAuNSIvPjxzdG9wIG9mZnNldD0iMC45NjIzMzMiIHN0b3AtY29sb3I9IndoaXRlIiBzdG9wLW9wYWNpdHk9IjAuMyIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0id2hpdGUiIHN0b3Atb3BhY2l0eT0iMCIvPjwvbGluZWFyR3JhZGllbnQ+PC9kZWZzPjwvc3ZnPgo=');
                                    background-color: #fff;
                                    border-radius: 20px;
                                    text-align: center;
                                    color: #2c3e50;
                                }

                                .tamara-popup__logo svg {
                                    height: 34px !important;
                                    width: 118px !important;
                                    margin-left: auto;
                                    margin-right: auto;
                                }

                                .tamara-popup__moto {
                                    font-style: normal;
                                    font-weight: bold;
                                    font-size: 28px;
                                    text-align: center;
                                    line-height: 36px !important;
                                    color: #000;
                                    margin-top: 21px !important;
                                }

                                .tamara-popup__submoto {
                                    font-style: normal;
                                    font-weight: normal;
                                    font-size: 14px;
                                    line-height: 20px;
                                    color: #a7a7a7;
                                    margin-top: 4px !important;
                                    margin-bottom: 16px !important;
                                }

                                .tamara-popup__link-work {
                                    margin-top: 8px !important;
                                    margin-bottom: 8px !important;
                                }

                                .tamara-popup__row {
                                    margin-top: 24px;
                                    display: flex;
                                    flex-direction: column;
                                }

                                .tamara-popup__col {
                                    display: flex;
                                    flex-basis: 100%;
                                    align-items: center;
                                    margin-bottom: 12px;
                                }

                                .tamara-popup__point-title {
                                    font-style: normal;
                                    font-weight: normal !important;
                                    font-size: 16px;
                                    line-height: 20px;
                                    color: #000;
                                    text-align: left;
                                    margin: 0 !important;
                                }

                                [dir='rtl'] .tamara-popup__point-title {
                                    text-align: right;
                                }

                                .tamara-popup__payment-method-note {
                                    font-style: normal;
                                    font-weight: normal;
                                    font-size: 12px;
                                    line-height: 19px;
                                    margin-top: 12px;
                                    margin-bottom: 24px;
                                    color: #666666;
                                    text-align: left;
                                }

                                [dir='rtl'] .tamara-popup__payment-method-note {
                                    text-align: right;
                                }

                                .tamara-popup__cta {
                                    margin-top: 24px;
                                    color: #666666;
                                    font-size: 14px;
                                    line-height: 22px;
                                }

                                .tamara-popup .tamara-popup__learn-button {
                                    display: inline;
                                    color: #8e64aa;
                                    text-decoration: underline;
                                    font-weight: normal;
                                    font-size: inherit;
                                    line-height: inherit;
                                }

                                .tamara-popup__footer {
                                    margin-top: 24px;
                                    color: #666666;
                                    font-size: 12px;
                                    line-height: 19px;
                                }

                                .tamara-popup__footer a {
                                    text-decoration: underline;
                                    color: inherit;
                                    font-weight: normal;
                                }

                                [dir='rtl'] .tamara-popup__close {
                                    right: unset;
                                    left: 24px;
                                }

                                [dir='rtl'] .tamara-popup__footer {
                                    font-weight: 600;
                                    font-size: 10px;
                                    line-height: 19px;
                                }

                                .tamara-popup__point-title__wrap {
                                    margin-left: 16px;
                                }

                                [dir='rtl'] .tamara-popup__point-title__wrap {
                                    margin-left: 0;
                                    margin-right: 16px;
                                }

                                .tamara-popup__line {
                                    background-color: #f2f2f2;
                                    height: 1px;
                                    margin-top: 24px;
                                    margin-bottom: 24px;
                                }

                                .tamara-popup__why-title {
                                    font-size: 16px;
                                    color: #000;
                                    font-weight: 700;
                                }

                                .tamara-popup__why-points {
                                    display: flex;
                                    align-items: center;
                                    justify-content: space-between;
                                    margin-right: auto;
                                    margin-left: auto;
                                    margin-top: 20px;
                                }

                                .tamara-popup__why-item {
                                    width: 120px;
                                    font-size: 12px;
                                }

                                .tamara-popup__why-item > div {
                                    margin-top: 10px;
                                }

                                [dir='rtl'] .tamara-popup__why-item > div {
                                    margin-top: 0;
                                }

                                @media (min-width: 768px) {
                                    .tamara-popup__point-title {
                                        font-size: 14px;
                                        text-align: center !important;
                                        margin-left: 0;
                                        margin-right: 0;
                                    }

                                    .tamara-popup__footer {
                                        margin-top: 28px;
                                    }

                                    .tamara-popup__cta {
                                        margin-top: 28px;
                                    }

                                    .tamara-popup__row {
                                        margin-top: 28px;
                                        flex-direction: row;
                                        align-items: baseline;
                                        justify-content: space-between;
                                    }

                                    .tamara-popup__col {
                                        flex-direction: column;
                                        margin-bottom: 0;
                                        align-items: center;
                                    }

                                    .tamara-popup__point-title__wrap {
                                        margin-right: 0 !important;
                                        margin-left: 0 !important;
                                        margin-top: 12px;
                                    }

                                    .md\:space-y-16 > :not(template) ~ :not(template) {
                                        margin-top: 16px !important;
                                    }

                                    .tamara-popup__close {
                                        top: 20px;
                                        right: 24px;
                                    }

                                    .tamara-popup__inner {
                                        padding: 25px 40px 40px;
                                    }

                                    .tamara-popup__logo svg {
                                        height: 28px !important;
                                        width: 130px !important;
                                    }

                                    .tamara-popup__moto {
                                        margin-top: 21px !important;
                                    }

                                    .tamara-popup__point-title {
                                        font-size: 14px;
                                        line-height: 20px;
                                    }

                                    .tamara-popup__payment-type__note {
                                        margin-top: 8px !important;
                                        font-size: 12px;
                                        line-height: 14px;
                                    }

                                    .tamara-popup__payment-method-note {
                                        text-align: center !important;
                                        font-size: 12px;
                                        line-height: 18px;
                                        margin-top: 16px;
                                        margin-bottom: 28px;
                                    }

                                    .tamara-popup__footer {
                                        font-size: 12px;
                                        line-height: 19px;
                                    }

                                    .tamara-popup__why-item {
                                        font-size: 14px;
                                    }

                                    .tamara-popup__icon,
                                    .tamara-popup__icon svg {
                                        width: 56px !important;
                                        height: 56px !important;
                                    }

                                    .tamara-popup__why-points {
                                        max-width: 65%;
                                    }

                                    .tamara-popup__line {
                                        margin-top: 28px;
                                        margin-bottom: 28px;
                                    }

                                    [dir='rtl'] .tamara-popup__close {
                                        right: unset;
                                        left: 24px;
                                    }

                                    [dir='rtl'] .tamara-popup__payment-type ul {
                                        text-align: right;
                                    }
                                } </style>
                            <div class="tamara-popup__inner" dir="rtl">
                                <div class="tamara-popup__logo">
                                    <svg width="100" height="28" viewBox="0 0 100 28" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1190_2848)">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M10.7038 6.48947C11.0411 5.6886 11.7906 4.12163 11.7906 4.12163C11.7906 4.12163 12.1429 3.47792 12.4052 3.50058C12.4942 3.50508 12.5814 3.5277 12.6614 3.56708C12.7415 3.60645 12.8128 3.66177 12.8711 3.72969C12.9294 3.79762 12.9734 3.87673 13.0005 3.96227C13.0276 4.04782 13.0373 4.13801 13.0288 4.22741C13.0318 4.70489 13.035 5.18236 13.0382 5.65984C13.058 8.62003 13.0779 11.5802 13.0288 14.5404C12.9974 16.4066 13.7709 17.6003 15.4843 18.2727C17.4001 19.0283 19.4179 19.3652 21.4476 19.5949C29.4167 20.494 38.9013 19.5148 46.9963 17.419C47.5285 17.2815 47.6904 16.8886 47.7578 16.4126C47.9092 15.3549 48.8386 14.4482 49.7216 13.9949C51.6749 12.9795 54.0134 12.9719 55.46 14.0508C56.2885 14.6681 56.6403 15.2923 57.136 16.1717L57.208 16.2993C57.938 17.5988 60.5404 17.62 61.96 17.5081C62.7244 17.4479 63.2415 17.3685 63.8134 17.2805C64.3036 17.2052 64.8342 17.1236 65.5953 17.0427C64.7318 16.1633 64.0947 15.5286 63.4036 14.891C63.0783 14.5888 62.9839 14.2926 63.1923 13.8755C63.3715 13.5143 63.5299 13.1445 63.6881 12.7755L63.6881 12.7754L63.6882 12.7752C63.8568 12.3818 64.025 11.9894 64.2176 11.609C64.3405 11.3657 64.6404 11.0635 64.8412 11.0514C65.4304 11.0125 65.5771 11.2336 65.7388 11.477C65.7532 11.4987 65.7677 11.5206 65.7826 11.5425C66.9144 13.2061 67.2188 15.0814 66.9909 17.0594C66.9744 17.2017 66.9641 17.331 66.954 17.4573L66.954 17.4575L66.954 17.4578C66.9248 17.8246 66.8976 18.1653 66.7271 18.7215C66.3583 19.9304 65.4514 20.7297 64.2221 21.0047C63.964 21.0627 63.7472 21.1128 63.5571 21.1567L63.5566 21.1568C62.662 21.3635 62.359 21.4335 61.119 21.5457C59.6155 21.6817 59.1283 20.9775 58.2558 19.5919C58.0536 20.2163 57.2602 20.4521 56.3665 20.7177L56.2246 20.7599C54.805 21.1815 49.873 21.2994 48.0052 20.8219C47.8877 20.7919 47.7893 20.7642 47.7042 20.7403L47.7041 20.7403C47.2312 20.6071 47.169 20.5896 46.5211 20.9443C45.842 21.316 41.9264 22.3375 40.6747 22.5022C36.6122 23.3227 32.4943 23.6204 28.3449 23.5841C25.8489 23.563 23.3499 23.4889 20.857 23.3454C18.8782 23.2305 16.9519 22.8497 15.1305 22.0141C12.5252 20.8189 11.14 18.7487 10.9331 15.9125C10.7552 13.4836 10.6481 11.0479 10.541 8.61323C10.5254 8.25786 10.5098 7.90251 10.4939 7.54721C10.4868 7.18345 10.5584 6.82249 10.7038 6.48947ZM48.9406 18.3181L55.5605 18.3982C55.5605 18.3982 56.0012 15.438 52.1246 15.5785C49.4308 15.6813 48.9406 18.3181 48.9406 18.3181ZM65.1351 5.35009L65.1921 5.40751C65.3781 5.59473 65.5257 5.81708 65.6263 6.06184C65.727 6.30661 65.7789 6.56898 65.7789 6.83395C65.7789 7.09892 65.727 7.36129 65.6263 7.60606C65.5257 7.85082 65.3781 8.07317 65.1921 8.26039C64.7618 8.69407 63.4936 9.39973 62.3633 8.26039L62.3048 8.20146C62.1191 8.01427 61.9717 7.79201 61.8711 7.54739C61.7706 7.30276 61.7188 7.04057 61.7188 6.77577C61.7188 6.51098 61.7706 6.24878 61.8711 6.00416C61.9717 5.75954 62.1191 5.53728 62.3048 5.35009C62.4906 5.16258 62.7112 5.01382 62.954 4.91233C63.1968 4.81084 63.4571 4.7586 63.72 4.7586C63.9828 4.7586 64.2431 4.81084 64.4859 4.91233C64.7288 5.01382 64.9494 5.16258 65.1351 5.35009ZM6.30705 11.6588C6.43597 11.417 6.79725 11.1601 7.04609 11.1601C7.30243 11.1647 7.65771 11.4336 7.78363 11.6815C10.1941 16.4096 9.617 20.982 6.99213 25.42C6.66255 25.9778 6.29916 26.5154 5.92771 27.065L5.92769 27.065L5.92766 27.065L5.92763 27.0651L5.9276 27.0651C5.75167 27.3254 5.57393 27.5883 5.39711 27.8574C4.94703 27.6723 4.50111 27.4906 4.05874 27.3104L4.05858 27.3103C2.82136 26.8062 1.61196 26.3134 0.417203 25.7903C0.222324 25.7056 -0.066997 25.55 0.0139528 25.0241C0.039437 24.8564 0.343748 24.601 0.538627 24.5255C1.05951 24.3216 1.58859 24.1374 2.11723 23.9532C3.0187 23.6393 3.91889 23.3258 4.775 22.9162C5.72313 22.4443 6.58848 21.8196 7.33691 21.0667C8.3203 20.092 8.42374 18.8515 7.65322 17.6879C7.08583 16.8274 6.39417 16.0523 5.70704 15.2823C5.61354 15.1775 5.52011 15.0728 5.4271 14.968C5.13628 14.6431 5.04333 14.3999 5.24721 13.9904C5.42261 13.6368 5.57813 13.2735 5.73364 12.9102L5.73366 12.9101C5.9144 12.4879 6.09513 12.0657 6.30705 11.6588ZM56.8722 5.48765C56.6737 5.68651 56.5167 5.92335 56.4104 6.18425L59.4461 8.83617C59.6004 8.74573 59.7425 8.63551 59.8688 8.50827L59.9303 8.44631C61.1295 7.23746 60.3875 5.88657 59.9303 5.42419C59.7334 5.22571 59.4997 5.06827 59.2425 4.96086C58.9853 4.85344 58.7096 4.79815 58.4312 4.79815C58.1528 4.79815 57.8771 4.85344 57.6199 4.96086C57.3627 5.06827 57.129 5.22571 56.9321 5.42419L56.8722 5.48765ZM2.72724 4.44046C2.73566 4.35077 2.72587 4.2603 2.69847 4.17455C2.67106 4.0888 2.62662 4.00958 2.56785 3.94171C2.50908 3.87384 2.43721 3.81875 2.35662 3.7798C2.27603 3.74085 2.18842 3.71885 2.09913 3.71515C1.83079 3.69248 1.48451 4.33468 1.48451 4.33468C1.48451 4.33468 0.734971 5.90317 0.39768 6.70252C0.25236 7.03556 0.180743 7.3965 0.18781 7.76026C0.203176 8.1029 0.218354 8.44553 0.233532 8.78816L0.233532 8.78817C0.279067 9.81607 0.324601 10.844 0.375194 11.8719C0.465138 13.8191 0.556582 15.7674 0.649524 17.7167C0.68407 18.4424 0.721923 19.1682 0.760075 19.8997L0.760076 19.8997L0.760079 19.8997C0.784838 20.3744 0.809722 20.8515 0.83391 21.3326H1.93423C2.01917 20.9069 2.12321 20.4828 2.22703 20.0596C2.45485 19.1309 2.68163 18.2064 2.70325 17.2784C2.74073 15.4606 2.73923 6.90198 2.72724 4.44046ZM93.8483 21.0455C97.246 21.0455 100 18.2691 100 14.8441C100 11.4192 97.246 8.64274 93.8483 8.64274C90.4505 8.64274 87.6961 11.4192 87.6961 14.8441C87.6961 18.2691 90.4505 21.0455 93.8483 21.0455ZM75.5175 10.7341C74.9612 11.3189 74.5256 12.0092 74.2358 12.7649L83.1163 20.1918C83.5547 19.9214 83.9576 19.5965 84.3156 19.2247L84.4879 19.0419C87.8459 15.4984 85.6392 11.6603 84.2976 10.3654C83.7202 9.80792 83.0395 9.37058 82.2945 9.07832C81.5494 8.78605 80.7545 8.64458 79.9552 8.66198C79.1559 8.67938 78.3679 8.85531 77.636 9.17972C76.9042 9.50414 76.2429 9.97069 75.6899 10.5527L75.5175 10.7341Z"
                                                  fill="black"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1190_2848">
                                                <rect width="100" height="28" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <p class="tamara-popup__moto">قسم فاتورتك على 4 دفعات بقيمة 122 ر.س</p>
                                <div class="tamara-popup__row">
                                    <div class="tamara-popup__col"><i class="tamara-popup__icon">
                                            <svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="56" height="56" rx="28" fill="#FF9B83"></rect>
                                                <path d="M40.8532 22.8934L38.3065 33.56C38.1998 34.0134 37.7998 34.3334 37.3332 34.3334H22.6665C22.2132 34.3334 21.8265 34.0267 21.7065 33.6L18.7998 22.9334L17.8932 19.6667H14.6665C14.1065 19.6667 13.6665 19.2134 13.6665 18.6667C13.6665 18.12 14.1065 17.6667 14.6665 17.6667H18.6665C19.1198 17.6667 19.5065 17.9734 19.6265 18.4L20.5198 21.6667H39.8798C40.1865 21.6667 40.4798 21.8134 40.6665 22.0534C40.8532 22.2934 40.9198 22.6 40.8532 22.8934ZM24.9732 36C23.6932 36 22.6665 37.0267 22.6665 38.3067C22.6665 39.5734 23.6932 40.6134 24.9732 40.6134C26.2398 40.6134 27.2798 39.5867 27.2798 38.3067C27.2665 37.0267 26.2398 36 24.9732 36ZM35.0265 36C33.7598 36 32.7198 37.0267 32.7198 38.3067C32.7198 39.5734 33.7465 40.6134 35.0265 40.6134C36.2932 40.6134 37.3332 39.5867 37.3332 38.3067C37.3332 37.0267 36.3065 36 35.0265 36Z"
                                                      fill="black"></path>
                                            </svg>
                                        </i>
                                        <div class="tamara-popup__point-title__wrap"><p
                                                    class="tamara-popup__point-title">أضف المنتجات إلى سلة التسوق</p>
                                        </div>
                                    </div>
                                    <div class="tamara-popup__col"><i class="tamara-popup__icon">
                                            <svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="56" height="56" rx="28" fill="#FF9B83"></rect>
                                                <g clip-path="url(#clip0_1163_5485)">
                                                    <path d="M13.5923 22.9343C12.901 23.6556 12.3597 24.507 12 25.4392L23.0357 34.5883C23.5791 34.2556 24.0777 33.8547 24.5194 33.3954L24.7348 33.1729C28.9161 28.8059 26.1695 24.0764 24.5036 22.4876C23.0556 21.102 21.1167 20.348 19.1131 20.3914C17.1094 20.4347 15.205 21.2719 13.8183 22.7188L13.5923 22.9343Z"
                                                          fill="black"></path>
                                                    <path d="M36.3592 35.6409C40.5791 35.6409 44.0001 32.22 44.0001 28C44.0001 23.7801 40.5791 20.3591 36.3592 20.3591C32.1392 20.3591 28.7183 23.7801 28.7183 28C28.7183 32.22 32.1392 35.6409 36.3592 35.6409Z"
                                                          fill="black"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1163_5485">
                                                        <rect width="32" height="15.2818" fill="white"
                                                              transform="translate(12 20.3591)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </i>
                                        <div class="tamara-popup__point-title__wrap"><p
                                                    class="tamara-popup__point-title">اختر تمارا عند الدفع</p></div>
                                    </div>
                                    <div class="tamara-popup__col"><i class="tamara-popup__icon">
                                            <svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="56" height="56" rx="28" fill="#FF9B83"></rect>
                                                <path d="M27.9996 41.4399C20.5862 41.4399 14.5596 35.4133 14.5596 27.9999C14.5596 20.5866 20.5862 14.5599 27.9996 14.5599C31.9729 14.5599 35.7196 16.3066 38.2796 19.3466C38.6396 19.7733 38.5862 20.3999 38.1596 20.7599C37.7462 21.1199 37.1062 21.0666 36.7462 20.6399C34.5729 18.0533 31.3862 16.5599 27.9996 16.5599C21.6929 16.5599 16.5596 21.6933 16.5596 27.9999C16.5596 30.4629 17.3425 32.7469 18.6724 34.616C20.6175 31.5843 24.1592 29.6532 27.9996 29.6532C32.1863 29.6532 36.373 32.2799 38.173 36.0532C38.293 36.2932 38.253 36.5732 38.0796 36.7866C37.9331 36.9556 37.7827 37.1204 37.6286 37.2809C37.5786 37.392 37.5067 37.4959 37.4129 37.5866C34.8929 40.0666 31.5462 41.4399 27.9996 41.4399Z"
                                                      fill="black"></path>
                                                <path d="M23.6663 22.9599C23.6663 25.3466 25.613 27.2933 27.9997 27.2933C30.3863 27.2933 32.333 25.3466 32.333 22.9599C32.333 20.5733 30.3863 18.6266 27.9997 18.6266C25.613 18.6266 23.6663 20.5733 23.6663 22.9599Z"
                                                      fill="black"></path>
                                                <path d="M37.973 32.3999C37.4263 32.3999 36.973 31.9466 36.973 31.3999V28.3999H33.9863C33.4397 28.3999 32.9863 27.9466 32.9863 27.3999C32.9863 26.8532 33.4397 26.3999 33.9863 26.3999H36.973V23.4132C36.973 22.8666 37.4263 22.4132 37.973 22.4132C38.5197 22.4132 38.973 22.8666 38.973 23.4132V26.3999H41.973C42.5197 26.3999 42.973 26.8532 42.973 27.3999C42.973 27.9466 42.5197 28.3999 41.973 28.3999H38.973V31.3999C38.973 31.9466 38.5197 32.3999 37.973 32.3999Z"
                                                      fill="black"></path>
                                            </svg>
                                        </i>
                                        <div class="tamara-popup__point-title__wrap"><p
                                                    class="tamara-popup__point-title">أضف بياناتك</p></div>
                                    </div>
                                    <div class="tamara-popup__col"><i class="tamara-popup__icon">
                                            <svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="56" height="56" rx="28" fill="#FF9B83"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M16.9998 19.48C16.9999 18.1867 18.0532 17.1334 19.3332 17.1334H39.853C41.5863 17.1334 42.9997 18.5601 42.9997 20.3067H40.9997C40.9997 19.6534 40.4931 19.1334 39.8532 19.1334H19.3332C19.1465 19.1334 18.9999 19.28 18.9998 19.48V20.3334H37.3332C38.6265 20.3334 39.6665 21.3867 39.6665 22.68V31.8134L40.6665 31.8134C40.8532 31.8134 40.9998 31.6667 40.9998 31.4667L40.9997 20.3067H42.9997L42.9998 31.4667C42.9998 32.76 41.9465 33.8134 40.6665 33.8134L39.6665 33.8134V34.6667C39.6665 35.96 38.6132 37.0134 37.3332 37.0134H15.9998C14.7198 37.0134 13.6665 35.96 13.6665 34.6667V22.68C13.6665 21.3867 14.7198 20.3334 15.9998 20.3334H16.9998V19.48ZM16.7865 28.8C16.7865 29.4667 17.3332 30.0134 17.9998 30.0134C18.6665 30.0134 19.2132 29.4667 19.2132 28.8C19.2132 28.1334 18.6665 27.5867 17.9998 27.5867C17.3332 27.5867 16.7865 28.1334 16.7865 28.8ZM20.9998 28.8C20.9998 31.56 23.2398 33.8 25.9998 33.8C28.7598 33.8 30.9998 31.56 30.9998 28.8C30.9998 26.04 28.7598 23.8 25.9998 23.8C23.2398 23.8 20.9998 26.04 20.9998 28.8ZM32.7865 28.8C32.7865 29.4667 33.3332 30.0134 33.9998 30.0134C34.6665 30.0134 35.2132 29.4667 35.2132 28.8C35.2132 28.1334 34.6665 27.5867 33.9998 27.5867C33.3332 27.5867 32.7865 28.1334 32.7865 28.8Z"
                                                      fill="black"></path>
                                            </svg>
                                        </i>
                                        <div class="tamara-popup__point-title__wrap"><p
                                                    class="tamara-popup__point-title">أكمل دفعتك الأولى</p></div>
                                    </div>
                                </div>
                                <div class="tamara-popup__payment-method-note">أكمل دفعاتك المتبقية خلال 3 أشهر أو وفقًا
                                    لطريقة الدفع التي اخترتها
                                </div>
                                <div class="tamara-popup__line"></div>
                                <div class="tamara-popup__why-title"> لماذا اختار تمارا كوسيلة دفع؟</div>
                                <div class="tamara-popup__why-points">
                                    <div class="tamara-popup__why-item">
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.74868 8.61942L7.18379 9.24039L7.37485 9.99635C7.57381 10.7444 7.57381 10.7444 7.57381 15.2333L7.57381 19.73L7.17589 20.1042C6.63467 20.6376 5.94226 20.8523 4.78838 20.8523C4.07188 20.8523 3.88912 20.8203 3.53108 20.6612C2.71946 20.2949 2.24179 19.4513 2.24179 18.4008C2.24179 18.0743 2.32943 17.4538 2.44075 16.9524C2.55206 16.4669 2.66338 15.9655 2.68747 15.838L2.72735 15.5992L2.54417 15.8222C2.32943 16.069 1.68479 17.6449 1.47752 18.4249C1.31843 19.0538 1.27856 20.6218 1.42186 21.0911C1.70057 21.9825 2.41666 22.7306 3.26815 23.0172C3.93647 23.2319 5.21787 23.2161 5.91859 22.9773C7.29552 22.4996 8.52126 21.2739 8.92707 19.953C9.07826 19.4754 9.08615 19.205 9.08615 15.4642L9.08615 11.4929L9.32499 10.928C9.46039 10.6256 9.56382 10.339 9.56382 10.2913C9.56382 10.2514 9.46039 10.0682 9.33288 9.88545C9.05417 9.47964 8.66414 8.69959 8.53704 8.29378C8.48138 8.13469 8.40952 7.99928 8.37006 7.99928C8.33767 7.99845 8.05107 8.27716 7.74868 8.61942Z"
                                                  fill="black"></path>
                                            <path d="M16.9171 9.61471C16.535 10.2116 16.5192 10.2594 16.5749 10.6095C16.6945 11.3734 16.7423 14.0873 16.6546 15.0107C16.4955 16.7058 16.042 18.0429 15.2698 19.0775C15.0866 19.3242 14.9275 19.5153 14.9117 19.4995C14.896 19.4837 14.9275 19.1893 14.9832 18.847C15.0388 18.5047 15.0866 17.6852 15.0787 17.0323C15.0787 15.6396 14.9354 14.9629 14.4183 13.9204C13.5826 12.2091 11.6723 10.2037 11.1789 10.514C10.9562 10.6494 10.7012 11.1665 10.55 11.7634C10.3274 12.6705 10.4865 13.228 11.1868 14.0159C11.5211 14.398 11.5847 14.4379 12.086 14.5251C13.0409 14.7004 13.2004 14.8117 13.7176 15.5918C14.2746 16.4512 14.5454 17.8123 14.442 19.2528C14.3863 20.0644 14.3942 20.0565 13.3994 20.7091C12.5795 21.2503 11.6486 21.6802 10.4944 22.0619C10.0088 22.221 9.571 22.3722 9.53943 22.4042C9.41192 22.5155 10.5741 22.675 11.5132 22.6667C13.0571 22.6588 13.9884 22.388 14.9516 21.6561C15.6519 21.1228 16.2729 20.3427 16.7344 19.4198C17.2041 18.4649 17.4347 17.6291 17.5065 16.5546L17.5701 15.7588L17.6735 16.3556C17.8567 17.3824 18.2305 18.592 18.6047 19.372C18.8992 19.9689 19.0824 20.2314 19.5759 20.7249C20.6425 21.7911 21.661 22.3165 22.9823 22.4918C23.7465 22.5873 24.0012 22.5633 25.9588 22.1338C27.2323 21.8551 28.458 21.6881 29.1662 21.6881L29.7631 21.6881L30.1768 20.6376C30.4235 20.0009 30.551 19.5714 30.495 19.5552C30.1448 19.436 29.2136 18.6559 28.0198 17.4937C26.014 15.5436 25.2979 15.1141 24.088 15.1777C23.1251 15.2333 22.5042 15.6234 21.8674 16.5783C21.3345 17.3903 21.3262 17.4223 21.7723 17.2312C23.1567 16.6422 24.088 16.7137 25.1783 17.4937C25.9899 18.0748 27.2555 19.4675 27.1043 19.6108C26.8813 19.8177 24.6691 20.1919 23.6502 20.1919C23.0375 20.1998 22.7746 20.16 22.2575 19.9851C21.9073 19.8659 21.4936 19.6906 21.342 19.5951C20.0286 18.8071 18.9703 17.4223 18.4847 15.8543C18.1346 14.7004 17.681 12.1534 17.4185 9.86932L17.3229 8.99374L16.9171 9.61471Z"
                                                  fill="black"></path>
                                        </svg>
                                        <div>متوافقة مع الشريعة الإسلامية</div>
                                    </div>
                                    <div class="tamara-popup__why-item">
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M21.3333 7H26.4533C27.8533 7 29 8.14667 29 9.54667V11.44V14.6667V17.3333V22.4533C29 23.8533 27.8667 25 26.4533 25H25.3333H21.3333H10.6667H5.54667C4.14667 25 3 23.8667 3 22.4533V18.6667V17.3333V14.6667V12V9.54667C3 8.14667 4.13333 7 5.54667 7H10.6667H21.3333ZM27 13H5V14.3333H27V13ZM10.6667 9H5.54667C5.25333 9 5 9.25333 5 9.54667V11H27V9.54667C27 9.25333 26.76 9 26.4533 9H21.3333H10.6667ZM26.4533 23C26.7467 23 27 22.76 27 22.4533V17.3333V16.3333H5V17.3333V18.6667V22.4533C5 22.7467 5.24 23 5.54667 23H10.6667H21.3333H25.3333H26.4533ZM7.33333 18.6667H16C16.5467 18.6667 17 19.12 17 19.6667C17 20.2133 16.5467 20.6667 16 20.6667H7.33333C6.78667 20.6667 6.33333 20.2133 6.33333 19.6667C6.33333 19.12 6.78667 18.6667 7.33333 18.6667Z"
                                                  fill="black"></path>
                                        </svg>
                                        <div>معلومات بطاقتك آمنة 100%</div>
                                    </div>
                                    <div class="tamara-popup__why-item">
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.7866 23.8667H15.8399C19.1732 23.8667 21.8532 21.6667 22.5066 18.4C22.6132 17.8533 22.2666 17.3333 21.7199 17.2267C21.1999 17.12 20.6532 17.4667 20.5466 18.0133C20.1999 19.7733 18.7732 21.84 15.9066 21.8667H15.8532C12.9466 21.8667 11.4932 19.7867 11.1466 18.0133C11.0399 17.4667 10.5066 17.12 9.97324 17.2267C9.42658 17.3333 9.07991 17.8533 9.18658 18.4C9.83991 21.6533 12.4799 23.84 15.7866 23.8667Z"
                                                  fill="black"></path>
                                            <path d="M23.0535 14.1867C22.8535 14.1867 22.6402 14.12 22.4668 14C20.9978 12.9305 19.4915 13.8908 19.3319 13.9926L19.3202 14C18.8668 14.3067 18.2402 14.2133 17.9335 13.76C17.6135 13.32 17.7068 12.6933 18.1602 12.3733C19.1068 11.68 21.4802 10.7867 23.6535 12.3733C24.0935 12.6933 24.2002 13.32 23.8802 13.7733C23.6668 14.04 23.3602 14.1867 23.0535 14.1867Z"
                                                  fill="black"></path>
                                            <path d="M13.0934 14C13.2668 14.12 13.4801 14.1867 13.6801 14.1867C13.9868 14.1867 14.2934 14.04 14.5068 13.7733C14.8268 13.32 14.7201 12.6933 14.2801 12.3733C12.1068 10.7867 9.73345 11.68 8.78678 12.3733C8.33345 12.6933 8.24012 13.32 8.56012 13.76C8.86678 14.2133 9.49345 14.3067 9.94678 14C9.94678 14 9.95294 13.9961 9.95848 13.9926C10.1181 13.8908 11.6245 12.9305 13.0934 14Z"
                                                  fill="black"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M3 16C3 23.1733 8.82667 29 16 29C23.1733 29 29 23.1733 29 16C29 8.82667 23.1733 3 16 3C8.82667 3 3 8.82667 3 16ZM5 16C5 9.93333 9.93333 5 16 5C22.0667 5 27 9.93333 27 16C27 22.0667 22.0667 27 16 27C9.93333 27 5 22.0667 5 16Z"
                                                  fill="black"></path>
                                        </svg>
                                        <div>سهلة وسريعة</div>
                                    </div>
                                </div>
                                <div class="tamara-popup__cta"> هل تريد معرفة المزيد؟ <a
                                            class="tamara-popup__learn-button"
                                            href="https://tamara.co/index.html#how-it-works" target="_black"
                                            rel="nofollow noopener"> انقر هنا </a></div>
                                <div class="tamara-popup__footer">(1) تطبّق <a
                                            href="https://www.tamara.co/terms-and-conditions.html" target="_blank">الشروط
                                        و الأحكام</a>, (2) موافقة <a
                                            href="https://www.tamara.co/shariah-compliance.html" target="_blank">للشريعة
                                        الإسلامية</a>, (3) متوفرة للعملاء في السعودية والإمارات (4) قد تختلف خطة الدفع
                                    المقدمة لك تبعًا لتاريخك الائتماني مع تمارا*.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- tammara modal--}}
    <div class="modal fade custom-modal" id="tabbyModal" tabindex="-1" aria-labelledby="tammaraModalLabel"
         aria-hidden="true" dir="rtl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img style="width:120px; float:left;" src="{{asset('frontend/imgs/tabby.png')}}">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body row" style="margin:20px;">
                    <div class="col-12  align-items-center align-content-center text-center">
                        <span class="fs-4 pb-2">قسّمها على 4 دفعات بدون فوائد</span>
                        <p>متوافق مع احكام الشريعة. بدون رسوم.</p>
                    </div>
                    <div class="col-12" style="padding-top: 30px;">
                        <h3 class="pb-3">طريقة الاستخدام:</h3>
                        <ul>
                            <li style="margin: 20px;">
                                <span style="padding-left: 10px;"><i class="fa-solid fa-circle-chevron-left"></i></span>
                                <span>اختر تابي عند الدفع</span>
                            </li>
                            <li style="margin: 20px;">
                                <span style="padding-left: 10px;"><i class="fa-solid fa-circle-chevron-left"></i></span>
                                <span>أدخل بياناتك و بيانات البطاقة البنكية أو البطاقة الائتمانية.</span>
                            </li>
                            <li style="margin: 20px;">
                                <span style="padding-left: 10px;"><i class="fa-solid fa-circle-chevron-left"></i></span>
                                <span>يتم سداد الدفعة الأولى عند إتمام الطلب.</span>
                            </li>
                            <li style="margin: 20px;">
                                <span style="padding-left: 10px;"><i class="fa-solid fa-circle-chevron-left"></i></span>
                                <span>سنرسل لك رسائل لتذكيرك بموعد استحقاق دفعتك القادمة.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick view -->
    @foreach($relatedProducts as $related)
        <div class="modal fade custom-modal" id="quickViewModal{{$related->id}}" tabindex="-1"
             aria-labelledby="quickViewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        @foreach($related->attachments as $media)
                                            <figure class="border-radius-10">
                                                <img src="{{asset('uploads/products/'.$media->filename)}}"
                                                     alt="product image">
                                            </figure>
                                        @endforeach
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @foreach($related->attachments as $media)
                                            <div><img src="{{asset('uploads/products/'.$media->filename)}}"
                                                      alt="product image"></div>
                                        @endforeach

                                    </div>
                                </div>
                                <!-- End Gallery -->
                                <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">
                                        <li><strong class="mr-10">Share this:</strong></li>
                                        <li class="social-facebook"><a href="#"><img
                                                        src="{{asset('frontend/imgs/theme/icons/icon-facebook.svg')}}"
                                                        alt=""></a></li>
                                        <li class="social-twitter"><a href="#"><img
                                                        src="{{asset('frontend/imgs/theme/icons/icon-twitter.svg')}}"
                                                        alt=""></a></li>
                                        <li class="social-instagram"><a href="#"><img
                                                        src="{{asset('frontend/imgs/theme/icons/icon-instagram.svg')}}"
                                                        alt=""></a></li>
                                        <li class="social-linkedin"><a href="#"><img
                                                        src="{{asset('frontend/imgs/theme/icons/icon-pinterest.svg')}}"
                                                        alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h3 class="title-detail mt-30" id="name{{$related->id}}">{{$related->name}}</h3>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> القسم : <a
                                                        href="shop-grid-right.html">{{$related->category->name}}</a></span>
                                        </div>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (25 تقييم)</span>
                                        </div>

                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left price-product">
                                            @if(isset($related->sale_price))
                                                <ins><span class="text-brand price-product-val"
                                                           id="price{{$related->id}}">{{$related->sale_price}}</span>
                                                </ins>
                                                <ins><span class="old-price font-md ml-15">{{$related->price}}</span>
                                                </ins>
                                                <span class="save-price  font-md color3 ml-15">{{$related->sale_price / $related->price * 100}} %</span>
                                            @else
                                                <ins><span class="text-brand price-product-val"
                                                           id="price{{$related->id}}">{{$related->price}}</span></ins>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <span class="d-inline-block text-truncate"
                                              style="max-width:200px;">{!! $related->name !!}</span>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p class="font-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                            Aliquam rem officia, corrupti reiciendis minima nisi modi,!</p>
                                    </div>
                                    @if(count($related->colors) > 0)
                                        <div class="attr-detail attr-color mb-15" id="choice_color">
                                            <strong class="mr-10">Color</strong>
                                            <ul class="list-filter color-filter">
                                                @foreach($related->colors as $color)
                                                    <li>
                                                        <a href="#" data-color="Red"
                                                           data-color-id="{{$color->id}}"><span
                                                                    style="background-color: {{$color->color}}"></span></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="color" value="" id="color_id">
                                            <input type="hidden" name="id" value="{{$related->id}}" id="product_id">
                                        </div>
                                    @endif
                                    @if(count($related->sizes) > 0)
                                        <div class="attr-detail attr-size" id="choice_size">
                                            <strong class="mr-10">Size</strong>
                                            <ul class="list-filter size-filter font-small">
                                                @foreach($related->sizes as $size)
                                                    <li><a href="#" data-size-id="{{$size->id}}">{{$size->size}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="size" value="" id="size_id">

                                        </div>
                                    @endif
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="detail-qty border radius quantity">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val val-span">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            <input type="hidden" class="qty-input qty-val" id="qty-val{{$related->id}}"
                                                   maxlength="2" max="10" value="1">


                                        </div>

                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart"
                                                    onclick="addToCart({{$related->id}})"
                                                    id="add_to_cart{{$related->id}}">{{trans('frontend.Add to cart')}}
                                                <i class="fi-rs-shopping-cart ml-5"></i></button>
                                            <a aria-label="{{trans('frontend.Add To Wishlist')}}"
                                               class="action-btn hover-up" onclick="addToWishlist({{$related->id}})"
                                               href="javascript:void(0)" id="add-to-wishlist{{$related->id}}"><i
                                                        class="fi-rs-heart"></i></a>
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">
                                            العلامات:
                                            @foreach($related->tags as $tag)
                                                <a href="#" rel="tag">{{$tag->name}}</a>,
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('script')

    <script>
        $(document).ready(function () {

            var price = $('.orig-price').text();
            var priceIs = parseInt(price);

            $('.installment-price').text(priceIs / 4);

            // use event delegation to listen for '.inliner' clicks
            $('#choice_color ul li a').on('click', function () {
                // when an element is clicked, update the search box
                $('input[name="color"]').val($(this).attr('data-color-id'));
                console.log($(this).attr('data-color-id'));
            })

            // use event delegation to listen for '.inliner' clicks
            $('#choice_size ul li a').on('click', function () {
                // when an element is clicked, update the search box
                $('input[name="size"]').val($(this).attr('data-size-id'));
                console.log($(this).attr('data-size-id'));
            })


            $('.qty-up').click(function (e) {
                e.preventDefault();
                var incre_value = $(this).parents('.quantity').find('.qty-val').val();
                var value = parseInt(incre_value);
                var price = $('.orig-price').text();
                var priceIs = parseInt(price);

                value = isNaN(value) ? 0 : value;
                if (value > 0) {
                    value++;
                    var total = priceIs * value;
                    $(this).parents('.quantity').find('.qty-val').val(value);

                    $('.installment-price').text(total / 4);
                    $('.price-value').text(total);
                }

                // price
                // installment-price
                // price-value

            });

            $('.qty-down').click(function (e) {
                e.preventDefault();
                var decre_value = $(this).parents('.quantity').find('.qty-val').val();
                var value = parseInt(decre_value);

                var price = $('.orig-price').text();
                var priceIs = parseInt(price);

                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    var total = priceIs * value;
                    $(this).parents('.quantity').find('.qty-val').val(value);
                    $('.installment-price').text(total / 4);
                    $('.price-value').text(total);
                }
            });

            $('.tammaraModal').click(function (e) {
                e.preventDefault();
                $('#tammaraModal').modal('show');
            });
            $('.tabbyModal').click(function (e) {
                e.preventDefault();
                $('#tabbyModal').modal('show');
            });


            $(".qty-up , .qty-down ").on("click input", function () {
                var quan = $(this).parents('.quantity').find('.qty-input').val();

                if (!quan || quan < 0)
                    return;
                var cost = parseFloat($('.price-product-val').text());
                var total = (cost * quan).toFixed(2);
                // selectors.find('.total').text(total); //add total
                console.log((cost * quan).toFixed(2))

            })


        });
    </script>
    <script>

        function addToCart(id) {
            var color = $('#color_id').val();
            var size = $('#size_id').val();
            var qty = $('#qty-val' + id).val();
            var price = $('#price' + id).text();

            $.ajax({
                type: 'post',
                url: "{{ route('frontend.addToCart') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'color': color,
                    'size': size,
                    'qty': qty,
                    'id': id,
                    'price': price,
                },

                beforeSend: function () {
                    $('#add_to_cart' + id).html('{{trans('frontend.Add to cart')}} <i class="fa-solid fa-cog fa-spin ml-5"></i>');
                },
                success: function (data) {
                    // $('#quick_view').modal('show');
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "تم اضافة المنتج الى سلة المشتريات"
                    });
                    $(".refresh-cart").load(location.href + " .refresh-cart");

                },
                error: function (response) {

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "error",
                        title: "عفوا! المنتج موجود فى سلة المشتريات"
                    });

                },
                complete: function (response) {
                    $('#add_to_cart' + id).html('{{trans('frontend.Add to cart')}}<i class="fi-rs-shopping-cart ml-5"></i>');

                    // $('#create_new'+id).html('save');
                }
            });

        }

        function addToWishlist(id) {


            $.ajax({
                type: 'post',
                url: "{{ route('frontend.addToWishlist') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': id,
                },

                beforeSend: function () {
                    $('#add-to-wishlist' + id).html('<i class="fa-solid fa-cog fa-spin ml-5"></i>');
                },
                success: function (data) {
                    // $('#quick_view').modal('show');
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "تم اضافة المنتج الى قائمة الامنيات"
                    });
                    $(".refresh-cart").load(location.href + " .refresh-cart");

                },
                error: function (response) {

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "error",
                        title: "عفوا! المنتج موجود فى قائمة الامنيات"
                    });

                },
                complete: function (response) {
                    $('#add-to-wishlist' + id).html('<i class="fi-rs-heart"></i>');

                    // $('#create_new'+id).html('save');
                }
            });

        }


    </script>

@endsection


