<!DOCTYPE html>
<html lang="zxx" class="js" dir="rtl">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>@yield('title')</title>
    <!-- StyleSheets  -->
    @include('Frontend.layout.head')
    @yield('style')
    <style>
        @media (min-width: 1540px) {
            .container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
                max-width: 1000px;
            }
        }
    </style>
</head>

<body class="nk-body bg-lighter has-rtl">
<div class="nk-app-root">
    <!-- wrap @s -->
    <div class="nk-wrap">
        <!-- main header @s -->
        <!-- main header @s -->

        <!-- main header @e -->
        <!-- content @s -->
        <div class="nk-content">
            <div class="container mt-5">
                <div class="nk-content-inner">
                    <div class="nk-content-body">

                        <div class="card card-bordered" >
                            <div class="card-inner">
                                <h5 class="font-bold text-sm mb-5">ملخص الطلب</h5>
                                <div class="d-flex justify-content-between">
                                    <span class="lead-text">مجموع المنتجات</span>
                                    <span class="lead-text">{{$data['cart_subtotal']*1}} ر.س </span>
                                </div>
                                <hr>
                                @if(session()->has('coupon'))
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="lead-text">قيمة خصم كوبون <span> ( {{session()->get('coupon')['code']}} )</span>  </span>
                                        <span class="lead-text">{{$data['cart_discount']}} ر.س  </span>
                                    </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="lead-text">الإجمالي</span>
                                    <span class="lead-text">{{$data['cart_total']}} ر.س  </span>
                                </div>
                            </div>
                        </div>
                </div>
                    <a  class="btn btn-primary btn-lg btn-block" id="droped"  href="javascript:void(0)">إتمام الطلب</a>

            </div>

        </div>


        <!-- content @e -->
        <!-- footer @s -->



        <!-- footer @e -->
    </div>
    <!-- wrap @e -->
</div>
<!-- app-root @e -->

<!-- JavaScript -->
@include('Frontend.layout.script')
@yield('script')
    <script>
        $('#droped').click(function (e) {
            e.preventDefault();
            $(".card-inner").slideUp(200);
            });
    </script>

</body>

</html>
