@extends('Frontend.layout2.master')
@section('title')
    المتجر
@endsection

@section('style')

@endsection

@section('content')
    <div class="page-header breadcrumb-wrap" dir="rtl">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('frontend.index')}}" rel="nofollow">{{trans('frontend.home')}}</a>
                <span></span><a href="{{route('frontend.shop')}}" rel="nofollow">{{trans('frontend.shop')}}</a>
                @if($categoryName != null)
                    <span></span><a href="{{route('frontend.shop',$categoryName->slug)}}"
                                    rel="nofollow">{{$categoryName->name}}</a>
                @endif
            </div>
        </div>
    </div>


    <section class="mt-50 mb-50" dir="rtl">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-product-fillter">
                        {{--                        <div class="sort-by-product-area">--}}
                        {{--                            <div class="sort-by-cover mr-10">--}}
                        {{--                                <div class="sort-by-product-wrap">--}}
                        {{--                                    <div class="sort-by">--}}
                        {{--                                        <span><i class="fi-rs-apps"></i>Show:</span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="sort-by-dropdown-wrap">--}}
                        {{--                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="sort-by-dropdown">--}}
                        {{--                                    <ul>--}}
                        {{--                                        <li><a class="active" href="#">50</a></li>--}}
                        {{--                                        <li><a href="#">100</a></li>--}}
                        {{--                                        <li><a href="#">150</a></li>--}}
                        {{--                                        <li><a href="#">200</a></li>--}}
                        {{--                                        <li><a href="#">All</a></li>--}}
                        {{--                                    </ul>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="sort-by-cover">--}}
                        {{--                                <div class="sort-by-product-wrap">--}}
                        {{--                                    <div class="sort-by">--}}
                        {{--                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="sort-by-dropdown-wrap">--}}
                        {{--                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="sort-by-dropdown">--}}
                        {{--                                    <ul>--}}
                        {{--                                        <li><a class="active" href="#">Featured</a></li>--}}
                        {{--                                        <li><a href="#">Price: Low to High</a></li>--}}
                        {{--                                        <li><a href="#">Price: High to Low</a></li>--}}
                        {{--                                        <li><a href="#">Release Date</a></li>--}}
                        {{--                                        <li><a href="#">Avg. Rating</a></li>--}}
                        {{--                                    </ul>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="row product-grid-3">
                        @foreach($products as $product)
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('frontend.product',$product->slug)}}">
                                                <img class="default-img"
                                                     src="{{asset('uploads/products/'.$product->firstMedia->filename)}}"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="{{trans('frontend.Quick view')}}" class="action-btn hover-up"
                                               data-bs-toggle="modal" data-bs-target="#quickViewModal{{$product->id}}">
                                                <i class="fi-rs-search"></i></a>
                                            <a aria-label="{{trans('frontend.Add To Wishlist')}}"
                                               class="action-btn hover-up" href="javascript:void(0)"
                                               onclick="addToWishlist({{$product->id}})"><i class="fi-rs-heart"></i></a>
                                        </div>

                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{route('frontend.shop',$product->category->slug)}}">{{$product->category->name}}</a>
                                        </div>
                                        <h5>
                                            <a href="{{route('frontend.product',$product->slug)}}">{{$product->name}}</a>
                                        </h5>
                                        <div style="padding-top: 10px !important;">
                                            <div class="product-price">
                                                @if($product->sale_price != null)
                                                    <span id="price{{$product->id}}">{{$product->sale_price}}</span>
                                                    <span>ر.س</span>
                                                    <span class="old-price">{{$product->price}}ر.س</span>
                                                @else
                                                    <span id="price{{$product->id}}">{{$product->price}}</span>
                                                    <span>ر.س</span>

                                                @endif
                                            </div>

                                            <div class="product-action-1 show text-center align-content-center align-items-center pt-md-3">
                                                <a aria-label="Add To Cart" class="btn btn-sm hover-up"
                                                   href="javascript:void(0)" onclick="addToCart({{$product->id}})"><i
                                                            class="fi-rs-shopping-cart"></i> إضافة للسلة </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Quick view -->
    @foreach($products as $related)
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
                    $(".refresh-cart").load(location.href + " .refresh-cart");

                },
                complete: function (response) {
                    $('#add-to-wishlist' + id).html('<i class="fi-rs-heart"></i>');

                    // $('#create_new'+id).html('save');
                }
            });

        }


    </script>

@endsection


