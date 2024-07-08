@extends('Frontend.layout.master')
@section('title')
    سلة التسوق
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
                                            <li class="breadcrumb-item"><a href="{{route('frontend.cart')}}">{{trans('frontend.cart')}}</a></li>

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
                    <div class="row g-gs" >
                        <div class="col-md-7">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <a href="#" class="btn btn-sm btn-icon btn-danger text-white border rounded-pill "  style="position: absolute; top: 15px; left: 15px;"><em class="icon ni ni-cross"></em></a>
                                    <div class="d-flex justify-content-md-between row ">
                                    <div class="d-inline-flex g2 col-lg-6 ">
                                        <div class="user-avatar sq w-100px h-100px">
                                            <span>AB</span>
                                        </div>
                                        <div style="margin-right: 30px;">
                                            <span class="lead">شنطة خوص مستطيل</span>
                                            <span class="sub-text">شنطة خوص مستطيل</span>
                                        </div>
                                    </div>
                                    <div class="d-inline-flex g2 col-lg-6">
                                        <div class="w-140px">
                                            <div class="form-control-wrap number-spinner-wrap quantity ">
                                                <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus qty-down" data-number="minus"><em class="icon ni ni-minus"></em></button>
                                                <input type="number" class="form-control number-spinner" id="qty-val"   value="1">
                                                <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus qty-up" data-number="plus"><em class="icon ni ni-plus"></em></button>
                                            </div>
                                        </div>
                                        <div class="d-flex text-center " style="margin-right: 15px;">
                                            <span class="lead-text">المجموع: </span>
                                            <span class="lead-text" >350 ر.س</span>
                                        </div>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 "></div>
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


            $('.qty-up-is').click(function (e) {
                e.preventDefault();

                var incre_value = $(this).parents('.quantity').find('.qty-val-is').text();
                var value = parseInt(incre_value);


                value = isNaN(value) ? 0 : value;
                if (value > 0) {
                    value++;
                    $(this).parents('.quantity').find('.qty-val-is').text(value);
                    var rowId = $(this).parents('.quantity').find('.rowId').val();

                    updateCart(rowId, value)
                }

            });

            $('.qty-down-is').click(function (e) {
                e.preventDefault();
                var decre_value = $(this).parents('.quantity').find('.qty-val-is').text();
                var value = parseInt(decre_value);


                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $(this).parents('.quantity').find('.qty-val-is').text(value);
                    var rowId = $(this).parents('.quantity').find('.rowId').val();

                    updateCart(rowId, value)

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
        function applyDiscount() {
            const coupon_code = $('#discount-value').val();
            $.ajax({
                type: 'post',
                url: "{{ route('frontend.applyDiscount')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'coupon_code': coupon_code,
                },

                beforeSend: function () {
                    $(this).html('<i class="fa-solid fa-cog fa-spin ml-5"></i>')
                },
                success: function (data) {
                    // $('#quick_view').modal('show');
                    $(".refresh-cart-now").load(location.href + " .refresh-cart-now");
                    $(".refresh-cart-is").load(location.href + " .refresh-cart-is");

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
                        title: "تم اضاضفة الكوبون  بنجاح"
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
                        title: "عفوا! يوجد خطاء"
                    });

                },
                complete: function (response) {

                    // $('#create_new'+id).html('save');
                }
            });

        }

        function removeDiscount() {
            $.ajax({
                type: 'get',
                url: "{{ route('frontend.removeCoupon')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },


                beforeSend: function () {
                },
                success: function (data) {
                    // $('#quick_view').modal('show');
                    $(".refresh-cart-now").load(location.href + " .refresh-cart-now");
                    $(".refresh-cart-is").load(location.href + " .refresh-cart-is");

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
                        title: "تم حذف الكوبون  بنجاح"
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
                        title: "عفوا! يوجد خطاء"
                    });

                },
                complete: function (response) {

                    // $('#create_new'+id).html('save');
                }
            });

        }


        function removeFromCart(rowId) {


            $.ajax({
                type: 'post',
                url: "{{ route('frontend.removeFromCart')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'rowId': rowId,
                },

                beforeSend: function () {

                },
                success: function (data) {
                    // $('#quick_view').modal('show');
                    if (data.count > 0) {
                        $("#itemIs" + rowId).slideUp(1000, function () {
                            $(this).remove();
                        });
                    } else {
                        $(".shopping-summery").load(location.href + " .shopping-summery")
                        $("#refresh-card-items").load(location.href + " #refresh-card-items")
                    }
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
                        title: "تم حذف المنتج  بنجاح"
                    });
                    $(".refresh-cart").load(location.href + " .refresh-cart");
                    $("#subtotal-product" + rowId).load(location.href + " #subtotal-product" + rowId)


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
                        title: "عفوا! يوجد خطاء"
                    });

                },
                complete: function (response) {

                    // $('#create_new'+id).html('save');
                }
            });

        }

        function emptyCart() {

            $.ajax({
                type: 'post',
                url: "{{ route('frontend.emptyCart') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {},

                beforeSend: function () {

                },
                success: function (data) {
                    // $('#quick_view').modal('show');
                    $(".shopping-summery").load(location.href + " .shopping-summery")
                    $("#refresh-card-items").load(location.href + " #refresh-card-items")

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
                        title: "تم تفريغ السلة بنجاح"
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
                        title: "عفوا! يوجد خطاء"
                    });

                },
                complete: function (response) {

                    // $('#create_new'+id).html('save');
                }
            });

        }

        function updateCart(rowId, qty) {
            const discount_value = $('#discount-value').val();

            $.ajax({
                type: 'post',
                url: "{{ route('frontend.updateCart') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'rowId': rowId,
                    'qty': qty,
                },

                beforeSend: function () {

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
                        title: "تم تحديث البيانات بنجاح"
                    });
                    $(".refresh-cart").load(location.href + " .refresh-cart");
                    $("#subtotal-product" + rowId).load(location.href + " #subtotal-product" + rowId);
                    $("#refresh-card-items").load(location.href + " #refresh-card-items")

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
                        title: "عفوا! يوجد خطاء"
                    });

                },
                complete: function (response) {

                    // $('#create_new'+id).html('save');
                }
            });

        }

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
                    $('#add_to_cart' + id).html('{{trans('frontend.Add to cart')}}<i class="fi-rs-shopping-bag ml-5"></i>');

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


