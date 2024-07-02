@extends('Frontend.layout2.master')
@section('title')
    الصفحة الرئيسية
@endsection

@section('style')

@endsection

@section('content')

    <section class="home-slider position-relative pt-25 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="position-relative">
                        <div class="hero-slider-1 style-3 dot-style-1 dot-style-1-position-1">
                            <div class="single-hero-slider single-animation-wrap">
                                <div class="container">
                                    <div class="slider-1-height-3 slider-animated-1">
                                        {{--                                        <div class="hero-slider-content-2">--}}
                                        {{--                                            <h4 class="animated">Trade-In Offer</h4>--}}
                                        {{--                                            <h2 class="animated fw-900">Supper Value Deals</h2>--}}
                                        {{--                                            <h1 class="animated fw-900 text-brand">On All Products</h1>--}}
                                        {{--                                            <p class="animated">Save more with coupons & up to 70% off</p>--}}
                                        {{--                                            <a class="animated btn btn-brush btn-brush-3" href="shop-product-right.html"> Shop Now </a>--}}
                                        {{--                                        </div>--}}
                                        <div class="slider-img">
                                            <img src="{{asset('uploads/banners/banner.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-hero-slider single-animation-wrap">
                                <div class="container">
                                    <div class="slider-1-height-3 slider-animated-1">
                                        {{--                                        <div class="hero-slider-content-2">--}}
                                        {{--                                            <h4 class="animated">Tech Promotions</h4>--}}
                                        {{--                                            <h2 class="animated fw-900">Tech Trending</h2>--}}
                                        {{--                                            <h1 class="animated fw-900 text-brand">Great Collection</h1>--}}
                                        {{--                                            <p class="animated">Save more with coupons & up to 20% off</p>--}}
                                        {{--                                            <a class="animated btn btn-brush btn-brush-3" href="shop-product-right.html"> Shop Now </a>--}}
                                        {{--                                        </div>--}}
                                        <div class="slider-img">
                                            <img src="{{asset('uploads/banners/banner2.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider-arrow hero-slider-1-arrow style-3"></div>
                    </div>
                </div>
                <div class="col-lg-3 d-md-none d-lg-block">
                    <div class="banner-img banner-1 wow fadeIn  animated home-3">
                        <img class="border-radius-10" src="{{asset('uploads/banners/banner3.png')}}" alt="">
                        {{--                        <div class="banner-text">--}}
                        {{--                            <span>Accessories</span>--}}
                        {{--                            <h4>Save 17% on <br>Autumn Hat</h4>--}}
                        {{--                            <a href="shop-grid-right.html">Shop Now <i class="fi-rs-arrow-right"></i></a>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="banner-img banner-2 wow fadeIn  animated mb-0">
                        <img class="border-radius-10" src="{{asset('uploads/banners/banner4.png')}}" alt="">
                        {{--                        <div class="banner-text">--}}
                        {{--                            <span>Smart Offer</span>--}}
                        {{--                            <h4>Save 20% on <br>Eardrop</h4>--}}
                        {{--                            <a href="shop-grid-right.html">Shop Now <i class="fi-rs-arrow-right"></i></a>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" section-padding wow fadeIn animated">
        <div class="container">
            <h1 class="section-title mb-20 text-center align-center align-content-center"><span>وصل</span> حديثا</h1>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                     id="carausel-4-columns-2-arrows1"></div>
                <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-21">
                    @foreach($featuredProducts as $product)

                        <div class="product-cart-wrap m-2 hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('frontend.product',$product->slug)}}">
                                        <img class="default-img"
                                             src="{{asset('uploads/products/'.$product->firstMedia->filename)}}" alt="">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="{{trans('frontend.Quick view')}}" class="action-btn hover-up"
                                       data-bs-toggle="modal" data-bs-target="#quickViewModal{{$product->id}}"><i
                                            class="fi-rs-eye"></i></a>
                                    <a aria-label="{{trans('frontend.Add To Wishlist')}}" class="action-btn hover-up"
                                       href="javascript:void(0)" onclick="addToWishlist({{$product->id}})"
                                       id="add-to-wishlist{{$product->id}}"><i class="fi-rs-heart"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">رائج</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category" dir="rtl">
                                    <a href="{{route('frontend.product',$product->slug)}}">{{$product->category->name}}</a>
                                </div>
                                <h2 style="direction: rtl"><a
                                        href="{{route('frontend.product',$product->slug)}}">{{$product->name}}</a></h2>
                                <div class="product-price" dir="rtl">
                                    @if(isset($product->sale_price))
                                        <span style=" text-align: right !important;"
                                              id="price{{$product->id}}">{{$product->sale_price}}</span><span>ر.س</span>
                                        <br>
                                        <span class="old-price" style=" text-align: right !important;">{{$product->price}} ر.س </span>
                                    @else
                                        <span id="price{{$product->id}}">{{$product->price}}</span>
                                    @endif

                                </div>
                                <div class="product-action-1 show text-center align-content-center align-items-center">
                                    <a aria-label="Add To Cart" class="btn btn-sm hover-up" href="javascript:void(0)"
                                       onclick="addToCart({{$product->id}})"> إضافة للسلة <i
                                            class="fi-rs-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--End product-cart-wrap-2-->
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <section class="banner-2 section-padding pb-0">
        <div class="container">
            <div class="banner-img banner-big wow fadeIn animated f-none">
                <img src="{{asset('uploads/banners/banner5.png')}}" alt="">
                {{--                <div class="banner-text d-md-block d-none">--}}
                {{--                    <h4 class="mb-15 mt-40 text-brand">Repair Services</h4>--}}
                {{--                    <h1 class="fw-600 mb-20">We're an Apple <br>Authorised Service Provider</h1>--}}
                {{--                    <a href="shop-grid-right.html" class="btn">Learn More <i class="fi-rs-arrow-right"></i></a>--}}
                {{--                </div>--}}
            </div>
        </div>
    </section>
    <section class="popular-categories section-padding mt-15">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20 text-center align-content-center align-center">الاقسام</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                <div class="carausel-6-columns" id="carausel-6-columns">
                    @foreach($product_categories as $categorey)
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <a href="{{route('frontend.shop',$categorey->slug)}}"><img
                                        src="{{$categorey->cover ? asset('uploads/'.$categorey->cover) : asset('frontend/imgs/shop/category-thumb-1.jpg')}}"
                                        alt=""></a>
                            </figure>
                            <h5><a href="{{route('frontend.shop',$categorey->slug)}}">{{$categorey->name}}</a></h5>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="pt-25 pb-20">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20 text-center align-content-center align-text-cetner"><span>وصل</span> حديثا
            </h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow"
                     id="carausel-6-columns-2-arrows"></div>
                <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                    @foreach($arrivalProducts as $arrival)
                        <div class="product-cart-wrap small hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('frontend.product',$arrival->slug)}}">
                                        <img class="default-img"
                                             src="{{asset('uploads/products/'.$arrival->firstMedia->filename)}}" alt="">
                                        {{--                                    <img class="hover-img" src="{{asset('frontend/imgs/shop/product-2-2.jpg')}}" alt="">--}}
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="{{trans('frontend.Quick view')}}" class="action-btn small hover-up"
                                       data-bs-toggle="modal" data-bs-target="#quickViewModal2{{$arrival->id}}">
                                        <i class="fi-rs-eye"></i></a>
                                    <a aria-label="{{trans('frontend.Add To Wishlist')}}"
                                       class="action-btn small hover-up" href="javascript:void(0)"
                                       onclick="addToWishlist({{$arrival->id}})" tabindex="0"
                                       id="add-to-wishlist{{$arrival->id}}"><i class="fi-rs-heart"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">{{$arrival->category->name}}</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a href="{{route('frontend.product',$arrival->slug)}}">{{$arrival->name}}</a></h2>
                                <div class="rating-result" title="90%">
                                    <span>
                                    </span>
                                </div>
                                <div class="product-price">
                                    @if(isset($arrival->sale_price))
                                        <span>ر.س {{$arrival->sale_price}} </span>
                                        <span class="old-price">{{$arrival->price}}</span>
                                    @else
                                        <span>{{$arrival->price}} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--End product-cart-wrap-2-->
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="banner-bg wow fadeIn animated">
                        <img src="{{asset('uploads/banners/banner5.png')}}" alt="">

                        <div class="banner-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Quick view -->
    @foreach($featuredProducts as $product)
        <div class="modal fade custom-modal" id="quickViewModal{{$product->id}}" tabindex="-1"
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
                                    <h3 class="title-detail mt-30" id="name{{$product->id}}">{{$product->name}}</h3>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> القسم : <a
                                                    href="shop-grid-right.html">{{$product->category->name}}</a></span>
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
                                            @if(isset($product->sale_price))
                                                <ins><span class="text-brand price-product-val"
                                                           id="price{{$product->id}}">{{$product->sale_price}}</span>
                                                </ins>
                                                <ins><span class="old-price font-md ml-15">{{$product->price}}</span>
                                                </ins>
                                                <span class="save-price  font-md color3 ml-15">{{$product->sale_price / $product->price * 100}} %</span>
                                            @else
                                                <ins><span class="text-brand price-product-val"
                                                           id="price{{$product->id}}">{{$product->price}}</span></ins>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <span class="d-inline-block text-truncate"
                                              style="max-width:200px;">{!! $product->name !!}</span>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p class="font-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                            Aliquam rem officia, corrupti reiciendis minima nisi modi,!</p>
                                    </div>
                                    @if(count($product->colors) > 0)
                                        <div class="attr-detail attr-color mb-15" id="choice_color">
                                            <strong class="mr-10">Color</strong>
                                            <ul class="list-filter color-filter">
                                                @foreach($product->colors as $color)
                                                    <li>
                                                        <a href="#" data-color="Red"
                                                           data-color-id="{{$color->id}}"><span
                                                                style="background-color: {{$color->color}}"></span></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="color" value="" id="color_id">
                                            <input type="hidden" name="id" value="{{$product->id}}" id="product_id">
                                        </div>
                                    @endif
                                    @if(count($product->sizes) > 0)
                                        <div class="attr-detail attr-size" id="choice_size">
                                            <strong class="mr-10">Size</strong>
                                            <ul class="list-filter size-filter font-small">
                                                @foreach($product->sizes as $size)
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
                                            <input type="hidden" class="qty-input qty-val" id="qty-val{{$product->id}}"
                                                   maxlength="2" max="10" value="1">


                                        </div>

                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart"
                                                    onclick="addToCart({{$product->id}})"
                                                    id="add_to_cart{{$product->id}}">{{trans('frontend.Add to cart')}}
                                                <i class="fi-rs-shopping-cart ml-5"></i></button>
                                            <a aria-label="{{trans('frontend.Add To Wishlist')}}"
                                               class="action-btn hover-up" onclick="addToWishlist({{$product->id}})"
                                               href="javascript:void(0)" id="add-to-wishlist{{$product->id}}"><i
                                                    class="fi-rs-heart"></i></a>
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">
                                            العلامات:
                                            @foreach($product->tags as $tag)
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
    @foreach($arrivalProducts as $arrival)
        <div class="modal fade custom-modal" id="quickViewModal2{{$arrival->id}}" tabindex="-1"
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
                                        @foreach($arrival->attachments as $media)
                                            <figure class="border-radius-10">
                                                <img src="{{asset('uploads/products/'.$media->filename)}}"
                                                     alt="product image">
                                            </figure>
                                        @endforeach
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @foreach($arrival->attachments as $media)
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
                                    <h3 class="title-detail mt-30" id="name{{$arrival->id}}">{{$arrival->name}}</h3>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> القسم : <a
                                                    href="shop-grid-right.html">{{$arrival->category->name}}</a></span>
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
                                            @if(isset($arrival->sale_price))
                                                <ins><span class="text-brand price-product-val"
                                                           id="price{{$arrival->id}}">{{$arrival->sale_price}}</span>
                                                </ins>
                                                <ins><span class="old-price font-md ml-15">{{$arrival->price}}</span>
                                                </ins>
                                                <span class="save-price  font-md color3 ml-15">{{$arrival->sale_price / $arrival->price * 100}} %</span>
                                            @else
                                                <ins><span class="text-brand price-product-val"
                                                           id="price{{$arrival->id}}">{{$arrival->price}}</span></ins>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <span class="d-inline-block text-truncate"
                                              style="max-width:200px;">{!! $arrival->name !!}</span>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p class="font-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                            Aliquam rem officia, corrupti reiciendis minima nisi modi,!</p>
                                    </div>
                                    @if(count($arrival->colors) > 0)
                                        <div class="attr-detail attr-color mb-15" id="choice_color">
                                            <strong class="mr-10">Color</strong>
                                            <ul class="list-filter color-filter">
                                                @foreach($arrival->colors as $color)
                                                    <li>
                                                        <a href="#" data-color="Red"
                                                           data-color-id="{{$color->id}}"><span
                                                                style="background-color: {{$color->color}}"></span></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="color" value="" id="color_id">
                                            <input type="hidden" name="id" value="{{$arrival->id}}" id="product_id">
                                        </div>
                                    @endif
                                    @if(count($arrival->sizes) > 0)
                                        <div class="attr-detail attr-size" id="choice_size">
                                            <strong class="mr-10">Size</strong>
                                            <ul class="list-filter size-filter font-small">
                                                @foreach($arrival->sizes as $size)
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
                                            <input type="hidden" class="qty-input qty-val" id="qty-val{{$product->id}}"
                                                   maxlength="2" max="10" value="1">


                                        </div>

                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart"
                                                    onclick="addToCart({{$arrival->id}})"
                                                    id="add_to_cart{{$arrival->id}}">{{trans('frontend.Add to cart')}}
                                                <i class="fi-rs-shopping-cart ml-5"></i></button>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                               href="javascript:void(0)" onclick="addToWishlist({{$arrival->id}})"
                                               id="add-to-wishlist{{$arrival->id}}"><i class="fi-rs-heart"></i></a>
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">
                                            العلامات:
                                            @foreach($arrival->tags as $tag)
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
                var incre_value = $(this).parents('.quantity').find('.qty-input').val();
                var value = parseInt(incre_value);
                value = isNaN(value) ? 0 : value;
                if (value > 0) {
                    value++;
                    $(this).parents('.quantity').find('.qty-input').val(value);
                    $(this).parents('.quantity').find('.val-span').text(value);
                }

            });

            $('.qty-down').click(function (e) {
                e.preventDefault();
                var decre_value = $(this).parents('.quantity').find('.qty-input').val();
                var value = parseInt(decre_value);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $(this).parents('.quantity').find('.qty-input').val(value);
                    $(this).parents('.quantity').find('.val-span').text(value);

                }
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


