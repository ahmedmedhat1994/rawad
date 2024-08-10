@extends('Frontend.layout.master')
@section('title')
    {{$product->name}}
@endsection

@section('style')

@endsection

@section('content')
    <div class="nk-content ">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <div class="">
                                    <nav>
                                        <ul class="breadcrumb breadcrumb-arrow" dir="rtl">
                                            <li class="breadcrumb-item"><a class="fs-12px" href="{{route('frontend.index')}}">{{trans('frontend.home')}}</a></li>
                                            <li class="breadcrumb-item"><a href="{{route('frontend.shop')}}">{{trans('frontend.shop')}}</a></li>
                                            <li class="breadcrumb-item"><a href="{{route('frontend.shop',$product->category->slug)}}">{{$product->category->name}}</a></li>
                                            <li class="breadcrumb-item active">{{$product->name}}</li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{route('frontend.shop')}}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>{{trans('frontend.back')}}</span></a>
                                <a href="{{route('frontend.shop')}}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row pb-5">
                                    <div class="col-lg-6 col-xxl-5">
                                        <div class="product-gallery me-xl-1 me-xxl-5">
                                            <div class="slider-init" id="sliderFor" data-slick='{"arrows": false, "fade": true, "asNavFor":"#sliderNav", "slidesToShow": 1, "slidesToScroll": 1}'>
                                                @foreach($product->attachments as $media)
                                                <div class="slider-item rounded">
                                                    <img src="{{asset('uploads/products/'.$media->filename)}}" class="rounded w-100" alt="{{$product->name}}">
                                                </div>
                                                @endforeach

                                            </div><!-- .slider-init -->
                                            <div class="slider-init slider-nav" id="sliderNav" data-slick='{"arrows": false, "slidesToShow": 5, "slidesToScroll": 1, "asNavFor":"#sliderFor", "centerMode":true, "focusOnSelect": true,
                                "responsive":[ {"breakpoint": 1539,"settings":{"slidesToShow": 4}}, {"breakpoint": 768,"settings":{"slidesToShow": 3}}, {"breakpoint": 420,"settings":{"slidesToShow": 2}} ]
                            }'>
                                                @foreach($product->attachments as $media)
                                                <div class="slider-item">
                                                    <div class="thumb">
                                                        <img src="{{asset('uploads/products/'.$media->filename)}}" class="rounded" alt="{{$product->name}}">
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div><!-- .slider-nav -->
                                        </div><!-- .product-gallery -->
                                    </div><!-- .col -->
                                    <div class="col-lg-6 col-xxl-5">
                                        <div class="product-info mt-5 me-xxl-5">
                                            @if(isset($product->sale_price))
                                            <h4 class="product-price text-primary">{{$product->sale_price}}  ر.س <small class="text-muted fs-14px">{{$product->price}} ر.س</small></h4>
                                            @else
                                                <h4 class="product-price text-primary">{{$product->price}} ر.س</h4>
                                            @endif
                                            <h4 class="product-title">{{$product->name}}</h4>
                                            <div class="product-rating">
                                                <ul class="rating">
                                                    <li><em class="icon ni ni-star-fill"></em></li>
                                                    <li><em class="icon ni ni-star-fill"></em></li>
                                                    <li><em class="icon ni ni-star-fill"></em></li>
                                                    <li><em class="icon ni ni-star-fill"></em></li>
                                                    <li><em class="icon ni ni-star-half"></em></li>
                                                </ul>
                                                <div class="amount">({{$product->reviews->count()}} تقييمات)</div>
                                            </div><!-- .product-rating -->
                                            <div class="product-excrept text-soft">
                                                <p class="lead"></p>
                                            </div>
                                            <div class="product-meta">
                                                <ul class="d-flex g-3 gx-5">
                                                    <li class="btn bg-lighter">
                                                        <i class="fas fa-solid fa-fire fa-beat-fade fs-21px"
                                                           style="color: #ff0000;"></i>
                                                        @php
                                                            $rand =rand('111','222');
                                                        @endphp
                                                        <span class="fs-6" style="margin-right: 10px;">تم شراءه <span class="text-danger">{{$rand}}</span> مرة</span>
                                                    </li>

                                                </ul>
                                            </div>
                                                <div class="product-meta font-xs mb-30" style="direction: rtl !important;">
                                                    <input type="hidden" value="{{isset($product->sale_price) ? $product->sale_price : $product->price}}" id="orig_price">
                                                    <ul>
                                                        <li class="mb-3">
                                                            <div class="position-relative border border-light rounded p-3 row tammaraModal"
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
                                                                         src="{{asset('frontend/assets/images/tammara.svg')}}" alt="">
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <li class="mb-10">
                                                            <div class="position-relative border border-light rounded p-3 row tabbyModal"
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
                                                                         src="{{asset('frontend/assets/images/tabby.png')}}" alt="">
                                                                </div>
                                                            </div>

                                                        </li>
                                                    </ul>
                                                </div>

                                            @if(isset($product->colors))
                                                <div class="product-meta">
                                                <h6 class="title">الألوان</h6>
                                                <ul class="custom-control-group">
                                                    @foreach($product->colors as $color)
                                                    <li>
                                                        <div class="custom-control color-control">
                                                            <input type="radio" class="custom-control-input" id="productColor{{$color->id}}" name="color" checked>
                                                            <label class="custom-control-label dot dot-xl" data-bg="{{$color->color}}" for="productColor{{$color->id}}"></label>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                    <input type="hidden" name="id" value="{{$product->id}}" id="product_id">
                                            </div>
                                                @endif
                                                @if(isset($product->sizes))

                                                <div class="product-meta">
                                                <h6 class="title">المقاسات</h6>
                                                <ul class="custom-control-group">
                                                    @foreach($product->sizes as $size)

                                                    <li>
                                                        <div class="custom-control custom-radio custom-control-pro no-control">
                                                            <input type="radio" class="custom-control-input" name="size" id="sizeCheck{{$size->id}}" checked>
                                                            <label class="custom-control-label" for="sizeCheck{{$size->id}}">{{$size->size}}</label>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div><!-- .product-meta -->
                                                @endif
                                            <div class="product-meta">
                                                <ul class="d-flex flex-wrap ailgn-center g-2 pt-1">
                                                    <li class="w-140px">
                                                        <div class="form-control-wrap number-spinner-wrap quantity">
                                                            <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus qty-down" data-number="minus"><em class="icon ni ni-minus"></em></button>
                                                            <input type="number" class="form-control number-spinner" id="qty-val"   value="1">
                                                            <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus qty-up" data-number="plus"><em class="icon ni ni-plus"></em></button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" class="btn    btn-lighter  "><span>السعر:</span> <span class="mx-5" id="price-value">{{isset($product->sale_price)? $product->sale_price : $product->price}}</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" id="add_to_cart{{$product->id}}" onclick="addToCart({{$product->id}})" class="btn  btn-dim  btn-outline-secondary btn-action "><em class="icon ni ni-bag"></em><span>{{trans('frontend.Add to cart')}}</span></a>
                                                    </li>
                                                    <li class="ms-n1">
                                                        <a  href="javascript:void(0)" onclick="addToWishlist({{$product->id}})" class="btn btn-icon  btn-outline-primary "><em class="icon ni ni-star"></em></a>
                                                    </li>
                                                </ul>

                                            </div><!-- .product-meta -->
                                        </div><!-- .product-info -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                                <hr class="hr border-light">

                            </div>
                        </div>
                    </div><!-- .nk-block -->
                    <div class="nk-block nk-block-lg ">
                        <div class="nk-block-head">
                            <div class="nk-block-between g-3">
                                <div class="nk-block-head-content">
                                    <h4 class="section-title style-1 mb-30">التعليقات</h4>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block-content my-5">
                            <form method="post" action="">
                            <div class="form-group">
                            <div class="form-control-wrap d-flex align-content-center align-items-center">
                                <textarea  class="form-control" id="default-01" rows="2" name="review" placeholder="ادخل سؤالك هنا" ></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">إرسال</button>
                            </div>
                            </form>
                        </div>

                        <div class="nk-block-content pt-5 my-5">
                            @foreach($product->reviews as $review)
                            <div class="card-inner">
                                <div class="nk-wg-action">
                                    <div class="nk-wg-action-content w-100">
                                        <em class="icon ni ni-user fs-1"></em>
                                        <div class="d-flex flex-row p-0">
                                            <div class="justify-content-start w-90" style="margin-right: 10px;">
                                                <span class="lead">{{($review->name != null)? $review->name : 'زائر'}}</span>
                                            </div>
                                            <div class=" justify-content-end">
                                                <span class="sub-text">{{date('d/m/y',strtotime($review->created_at))}}</span>
                                            </div>
                                        </div>
                                        <div class="sub-text" style="margin-right: 10px;">{{$review->message}}</div>
                                        @if($review->replay != null)
                                            <div style="padding-right: 50px; margin-top: 20px;">
                                                <em class="icon ni ni-curve-up-right" style="padding-right: 10px;"></em>
                                                <em class="icon ni ni-user fs-1" style="padding-right: 50px;"></em>
                                                <div class="d-flex flex-row p-0">
                                                    <div class="justify-content-start w-90">
                                                        <span class="lead-text">رواد الزى | RAWAD ZAY</span>
                                                    </div>
                                                    <div class=" justify-content-end">
                                                        <span class="sub-text">{{date('d/m/y',strtotime($review->created_at))}}</span>
                                                    </div>
                                                </div>
                                                <div class="sub-text">{{$review->replay}}</div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="nk-block nk-block-lg ">
                        <div class="nk-block-head">
                            <div class="nk-block-between g-3">
                                <div class="nk-block-head-content">
                                    <h4 class="section-title style-1 mb-30">منتجات قد تعجبك</h4>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="slider-init row" data-slick='{"arrows": false, "slidesToShow": 4,"centerMode": false, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1.5}} ]}'>
                            @foreach($relatedProducts as $product)
                                <div class="col">
                                    <div class="card card-bordered product-card" style="border-radius: .75rem;">
                                        <div class="product-thumb" >
                                            <a href="{{route('frontend.product',$product->slug)}}">
                                                <img class="card-img-top" src="{{asset('uploads/products/'.$product->firstMedia->filename)}}" alt="">
                                            </a>
                                            <ul class="product-badges">
                                                {{--                                                        <li class="d-flex justify-content-start"><span class="badge bg-success">New</span></li>--}}
                                            </ul>

                                        </div>
                                        <div class="card-inner text-center">
                                            <h6 class="product-title"><a href="{{route('frontend.product',$product->slug)}}">{{$product->name}}</a></h6>
                                            @if(isset($product->sale_price))
                                                <div class="product-price text-primary h6" ><small class="text-muted del fs-13px">{{$product->price}}  ر.س</small> {{$product->sale_price}} ر.س</div>
                                            @else
                                                <div class="product-price text-primary h6" >{{$product->price}}  ر.س</div>
                                            @endif
                                            <input type="hidden" id="price{{$product->id}}" value="{{(isset($product->sale_price) ? $product->sale_price : $product->price)}}">
                                            <a href="javascript:void(0)" id="add_to_cart{{$product->id}}" onclick="addToCart({{$product->id}})" class="btn  btn-dim btn-lg btn-outline-secondary btn-action mt-2"><em class="icon ni ni-bag"></em><span>{{trans('frontend.Add to cart')}}</span></a>
                                            <a  href="javascript:void(0)" onclick="addToWishlist({{$product->id}})" class="btn btn-icon btn-lg btn-outline-primary mt-2"><em class="icon ni ni-star"></em></a>

                                        </div>
                                    </div>
                                </div><!-- .col -->
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script>
        $(document).ready(function () {

            var price = $('#orig_price').val();
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
                var incre_value = $(this).parents('.quantity').find('#qty-val').val();
                var value = parseInt(incre_value);
                var price = $('#orig_price').val();
                var priceIs = parseInt(price);

                value = isNaN(value) ? 0 : value;
                if (value > 0) {
                    value+1;
                    var total = priceIs * value;
                    $(this).parents('.quantity').find('#qty-val').val(value);

                    $('.installment-price').text(total / 4);
                    $('#price-value').text(total);
                }

                // price
                // installment-price
                // price-value

            });

            $('.qty-down').click(function (e) {
                e.preventDefault();
                var decre_value = $(this).parents('.quantity').find('#qty-val').val();
                var value = parseInt(decre_value);

                var price = $('#orig_price').val();
                var priceIs = parseInt(price);

                value = isNaN(value) ? 0 : value;
                if (value > 1 || value != 0) {
                    value-1;
                    var total = priceIs * value;
                    $(this).parents('.quantity').find('#qty-val').val(value);
                    $('.installment-price').text(total / 4);
                    $('#price-value').text(total);
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


            $(".qty-up , .qty-down ").on("input", function () {
                var quan = $(this).parents('.quantity').find('#qty-val').val();

                if (!quan || quan < 0)
                    return;
                var cost = parseFloat($('#orig_price').val());
                var total = (cost * quan).toFixed(2);
                // selectors.find('.total').text(total); //add total
                console.log((cost * quan).toFixed(2))

            })


        });
    </script>
    <script>

        function addToCart(id) {
            var color = $('#productColor'+id).val();
            var size = $('#sizeCheck'+id).val();
            var qty = $('#qty-val').val();
            var price = $('#price-value').text();
            var priceIs = parseInt(price);

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
                    'price': priceIs,
                },

                beforeSend: function () {
                    $(this).html('<i class="fas fa-spinner fa-spin"></i>'+'<span>{{trans('frontend.Add to cart')}}</span');
                },
                success: function (data) {
                    // $('#quick_view').modal('show');
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger",
                            iconHtml:"ltr"
                        },
                        buttonsStyling: false
                    });
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 30000,
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
                    $('#add_to_cart' + id).html('<em class="icon ni ni-bag"></em>'+'<span>{{trans('frontend.Add to cart')}}</span');

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


