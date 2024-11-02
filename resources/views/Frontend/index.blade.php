@extends('Frontend.layout.master')
@section('title')
    الصفحة الرئيسية
@endsection

@section('style')
<style>
    /*.product-thumb {*/
    /*    width: 100%; !* يمكنك ضبط العرض حسب احتياجاتك *!*/
    /*    height: 250px; !* حدد الارتفاع المطلوب *!*/
    /*    overflow: hidden;*/
    /*    position: relative;*/
    /*}*/

    /*.product-thumb img {*/
    /*    width: 100%;*/
    /*    height: 100%;*/
    /*    !* لضمان تناسب العرض مع الصورة *!*/
    /*    position: absolute;*/
    /*    top: 50%;*/
    /*    left: 50%;*/
    /*    transform: translate(-50%, -50%);*/
    /*    object-fit:fill; !* يضمن ملء الصورة للعنصر بدون تمدد *!*/
    /*}*/
</style>
@endsection

@section('content')

    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                     <div class="col-12">
                                 <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                     <div class="carousel-inner rounded-5">
                                         <div class="carousel-item active">
                                             <img src="{{asset('frontend/banners/banner.png')}}" class="d-block w-100" alt="...">
                                         </div>
                                     </div>
                                 </div>
                     </div>
                        <div class="col-12 mt-5">
                            <div class="nk-block nk-block-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">{{trans('frontend.new Arrive')}}</h3>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="slider-init row" data-slick='{"arrows": false, "slidesToShow": 4,"centerMode": false, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1.5}} ]}'>
                                @foreach($arrivalProducts as $product)
                                    <div class="col" >
                                        <div class="card card-bordered product-card" style="border-radius: .75rem;">
                                            <div class="product-thumb" >
                                                <a href="{{route('frontend.product',$product->slug)}}">
                                                    <img class="card-img-top" src="{{asset('uploads/products/'.$product->firstMedia->filename)}}" alt="">
                                                </a>
                                                <ul class="product-badges">
                                                    <li class="d-flex justify-content-start"><span class="badge badge-sm badge-dim fs-4 bg-danger">{{trans('frontend.New')}}</span></li>
                                                </ul>

                                            </div>
                                            <div class="card-inner text-center">
                                                <h6 class="product-title"><a href="{{route('frontend.product',$product->slug)}}">{{$product->name}}</a></h6>
                                                @if(isset($product->sale_price)&& $product->sale_price > 0 )
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
                        <div class="col-12 mt-5">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner rounded-5">
                                    <div class="carousel-item active">
                                        <img src="{{asset('frontend/banners/banner5.png')}}" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <div class="nk-block nk-block-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">{{trans('frontend.best seller')}}</h3>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="slider-init row" data-slick='{"arrows": false, "slidesToShow": 4,"centerMode": false, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1.5}} ]}'>
                                    @foreach($featuredProducts as $product)
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
                                                    @if(isset($product->sale_price)&& $product->sale_price > 0 )                                                        <div class="product-price text-primary h6" ><small class="text-muted del fs-13px">{{$product->price}}  ر.س</small> {{$product->sale_price}} ر.س</div>
                                                    @else
                                                        <div class="product-price text-primary h6" >{{$product->price}}  ر.س</div>
                                                    @endif
                                                    <input type="hidden" value="{{isset($product->sale_price) && $product->sale_price > 0 ? $product->sale_price : $product->price}}" id="orig_price{{$product->id}}">
                                                    <a href="javascript:void(0)" id="add_to_cart{{$product->id}}" onclick="addToCart({{$product->id}})" class="btn  btn-dim btn-lg btn-outline-secondary btn-action mt-2"><em class="icon ni ni-bag"></em><span>{{trans('frontend.Add to cart')}}</span></a>
                                                    <a  href="javascript:void(0)" onclick="addToWishlist({{$product->id}})" class="btn btn-icon btn-lg btn-outline-primary mt-2"><em class="icon ni ni-star"></em></a>

                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <div class="nk-block nk-block-lg">
                               <div class="row gy-5">
                                   <div class="col-md-4">
                                       <div class="card card-bordered pricing text-center">
                                           <div class="user-card user-card-s2">
                                               <div class="user-card user-card-s2">
                                                   <div class="user-avatar lg bg-black">
                                                       <span>
                                                          <em class="fas fa-shipping-fast"></em>
                                                       </span>
                                                   </div>
                                                   <div class="user-info">
                                                       <h6>توصيل سريع !</h6>
                                                       <span class="lead-text">اختياراتك الجميلة ستكون معك في أقرب وقت ..</span>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="card card-bordered pricing text-center">
                                           <div class="user-card user-card-s2">
                                               <div class="user-card user-card-s2">
                                                   <div class="user-avatar lg bg-black">
                                                       <span>
                                                          <em class="fas fa-globe-asia"></em>
                                                       </span>
                                                   </div>
                                                   <div class="user-info">
                                                       <h6>أذواق متعددة!</h6>
                                                       <span class="lead-text">نجوب الأرض بحثًا عن ذوقك الخاص</span>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="card card-bordered pricing text-center">
                                           <div class="user-card user-card-s2">
                                               <div class="user-card user-card-s2">
                                                   <div class="user-avatar lg bg-black">
                                                       <span>
                                                          <em class="fas fa-crown"></em>
                                                       </span>
                                                   </div>
                                                   <div class="user-info">
                                                       <h6>اهتمام رفيع!</h6>
                                                       <span class="lead-text">نهتم جيدًا بتغليف منتجاتنا لتصل إليك كما اخترتها ..</span>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <div class="nk-block nk-block-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content w-100  align-items-center align-content-center text-center">
                                            <h3 class="nk-block-title page-title" >{{trans('frontend.customers reviews')}}
                                            <hr>
                                            </h3>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="slider-init row" data-slick='{"arrows": true, "slidesToShow": 2,"centerMode": false, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}} ]}'>
                                    @foreach($reviews as $review)
                                    <div class="col">
                                        <div class="card card-bordered ">
                                            <div class="card-inner">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-circle icon-circle-lg bg-white">
                                                            <em class="icon ni ni-user text-primary fs-1"></em>
                                                        </div>
                                                        <div class="ms-3">
                                                            <span class="text-soft ml-1 lead-text">{{$review->message}}</span>
                                                            <span class="text-soft">{{$review->user->full_name}}</span>
                                                        </div>
                                                        <div class="ms-3" >
                                                            <div style="margin-bottom: 100%;">
                                                                <span class=""><em class="icon ni ni-quote-right" style="font-size: 80px;"></em></span>

                                                            </div>
                                                            <div>
                                                                <span class="text-orange" ><em class="icon ni ni-star-fill"></em><em class="icon ni ni-star-fill"></em><em class="icon ni ni-star-fill"></em><em class="icon ni ni-star-fill"></em><em class="icon ni ni-star-fill"></em></span>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>

        function addToCart(id) {
            var color = $('#color_id').val();
            var size = $('#size_id').val();
            var qty = $('#qty-val' + id).val();
            var price = parseInt($('#orig_price' + id).val());

            $.ajax({
                type: 'post',
                url: "{{ route('frontend.addToCart') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'qty': 1,
                    'id': id,
                    'price': price,
                },

                beforeSend: function () {
                    $(this).html('<i class="fas fa-spinner fa-spin"></i>'+'<span>{{trans('frontend.Add to cart')}}</span');
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


