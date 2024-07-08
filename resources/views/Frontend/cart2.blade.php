@extends('Frontend.layout2.master')
@section('title')
    سلة التسوق
@endsection

@section('style')

@endsection

@section('content')
    <div class="page-header breadcrumb-wrap" dir="rtl">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('frontend.index')}}" rel="nofollow">{{trans('frontend.home')}}</a>
                <span></span><a href="{{route('frontend.cart')}}" rel="nofollow">{{trans('frontend.cart')}}</a>

            </div>
        </div>
    </div>

    <section class="mt-50 mb-50" dir="rtl">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            @if(count(Cart::content()) > 0)
                                <thead>
                                <tr class="main-heading">
                                    <th scope="col">صورة المنتج</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">السعر</th>
                                    <th scope="col">الكمية</th>
                                    <th scope="col">الاجمالي</th>
                                    <th scope="col">حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::content() as $cart)
                                    <tr id="itemIs{{$cart->rowId}}">
                                        <td class="image product-thumbnail"><img
                                                    src="{{asset('uploads/products/'.$cart->model->firstMedia->filename)}}"
                                                    alt="#"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a
                                                        href="{{route('frontend.product',$cart->model->slug)}}">{{$cart->model->name}}</a>
                                            </h5>

                                        </td>
                                        @if($cart->model->sale_price != null and $cart->model->sale_price != '0')
                                            <td class="price" data-title="Price">
                                                <span>{{$cart->model->sale_price}}</span>ر.س
                                            </td>
                                        @else
                                            <td class="price" data-title="Price"><span>{{$cart->model->price}}</span>ر.س
                                            </td>
                                        @endif
                                        <td class="text-center" data-title="Stock">
                                            <div class="detail-qty border radius  m-auto quantity">
                                                <a href="javascript:void(0)" class="qty-down-is"><i
                                                            class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val-is">{{$cart->qty}}</span>
                                                <a href="javascript:void(0)" class="qty-up-is"><i
                                                            class="fi-rs-angle-small-up"></i></a>
                                                <input class="rowId" value="{{$cart->rowId}}" type="hidden">
                                            </div>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span id="subtotal-product{{$cart->rowId}}">{{$cart->subtotal}}</span><span>ر.س</span>
                                        </td>
                                        <td class="action" data-title="Remove"><a href="javascript:void(0)"
                                                                                  onclick="removeFromCart('{{$cart->rowId}}')"
                                                                                  class="text-muted"><i
                                                        class="fi-rs-trash"></i></a></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            @endif
                            @if(count(Cart::content()) == 0)
                                <tr>
                                    <td class="pl-0 border-light" colspan="6">
                                        <p class="text-center">لايوجد منتجات فى السلة</p>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div id="refresh-card-items">
                        <div class="cart-action text-end">
                            @if(count(Cart::content()) > 0)
                                <a class="btn mr-10 mb-sm-15" href="javascript:void(0)" onclick="emptyCart()"><i
                                            class="fi-rs-delete ml-10"></i>تفريغ السلة</a>
                            @endif
                            <a class="btn" href="{{route('frontend.shop')}}"><i class="fi-rs-shopping-cart ml-10"></i>متابعة
                                التسوق</a>
                        </div>
                        @if(count(Cart::content()) > 0)
                            <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                            <div class="row mb-50">
                                <div class="col-lg-12 col-md-12">
                                    <div class="border p-md-4 p-30 border-radius cart-totals">
                                        <div class="heading_s1 mb-3">
                                            <h4>ملخص الطلب</h4>
                                        </div>
                                        <div class="mb-30 mt-50">
                                            <div class="heading_s1 mb-3">
                                                <h4>هل لديك كود خصم</h4>
                                            </div>
                                            <div class="total-amount refresh-cart-now">
                                                <div class="left">
                                                    <div class="coupon">
                                                        <form action="#" target="_blank">
                                                            <div class="form-row row justify-content-center">
                                                                <div class="form-group col-lg-6">
                                                                    @if(!session()->has('coupon'))
                                                                        <input class="font-medium" name="Coupon"
                                                                               id="discount-value"
                                                                               placeholder="ادخل كود الخصم">
                                                                    @else
                                                                        <input class="font-medium " disabled
                                                                               name="Coupon" id="discount-value"
                                                                               value="{{session()->get('coupon')['code']}}"
                                                                               placeholder="ادخل كود الخصم">
                                                                    @endif
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    @if(!session()->has('coupon'))
                                                                        <a class="btn  btn-sm" href="javascript:void(0)"
                                                                           onclick="applyDiscount()"><i
                                                                                    class="fi-rs-label ml-10"></i>تطبيق</a>
                                                                    @else
                                                                        <a class="btn-danger btn-lg"
                                                                           href="javascript:void(0)"
                                                                           onclick="removeDiscount()"><i
                                                                                    class="fa-solid fa-xmark"></i></a>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive refresh-cart-is">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td class="cart_total_label">مجموع المنتجات
                                                    </td>
                                                    <td class="cart_total_amount"><span
                                                                class="font-lg fw-900 text-brand">{{$data['cart_subtotal']*1}} ر.س </span>
                                                    </td>
                                                </tr>
                                                @if(session()->has('coupon'))
                                                    <tr>
                                                        <td class="cart_total_label">الخصم <span class="text-danger">( {{session()->get('coupon')['code']}} )</span>
                                                        </td>
                                                        <td class="cart_total_amount"><strong><span
                                                                        class="font-xl fw-500 text-danger">- {{session()->get('coupon')['discount']}}  ر.س </span></strong>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if(session()->has('coupon'))
                                                    <tr>
                                                        <td class="cart_total_label">الإجمالي
                                                        </td>
                                                        <td class="cart_total_amount"><strong><span
                                                                        class="font-xl fw-900 text-brand">{{$data['cart_total']}}  ر.س  </span></strong>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="cart_total_label">الإجمالي
                                                        </td>
                                                        <td class="cart_total_amount"><strong><span
                                                                        class="font-xl fw-900 text-brand">{{$data['cart_total']}} ر.س  </span></strong>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        <a href="{{route('frontend.checkout')}}" class="btn "> <i
                                                    class="fi-rs-box-alt mr-10"></i> إتمام الطلب </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

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


