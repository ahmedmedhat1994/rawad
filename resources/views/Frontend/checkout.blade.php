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
.setup_action{
    cursor: pointer;
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

                        <div class="card card-bordered refresh-cart-now" >
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
                                @if(session()->has('shipping'))
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="lead-text">تكلفة الشحن  </span>
                                        <span class="lead-text">{{session()->get('shipping')['cost']}} ر.س </span>
                                    </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="lead-text">الإجمالي</span>
                                    <span class="lead-text">{{$data['cart_total']}} ر.س  </span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <div class="setup_action" id="setup_01">
                                <div class="d-flex justify-content-between justify-items-center mb-3">
                                    <div class="d-inline-flex">
                                        <div class="user-avatar bg-light">
                                            <span>1</span>
                                        </div>
                                        <div style="margin-right: 15px;">
                                            <span class="lead-text">{{trans('frontend.address shipping')}}</span>
                                            <span class="sub-text" id="setup_01_subtitle">-</span>
                                        </div>
                                    </div>
                                    <div class="d-flex  justify-content-center align-items-center ">
{{--                                        <a href="#" class="btn btn-outline-primary">{{trans('frontend.edit')}}</a>--}}
                                    </div>
                                </div>
                                </div>
                                <div id="shipping_address" style="display: none;">
                                    @forelse($data['user_addresses'] as $address)
                                    <div class="pt-2" style="padding-right: 10px;">
                                        <div class="custom-control custom-radio">
                                            <input type="radio"
                                                   id="updateUserAddress{{$address->id}}"
                                                   value="{{$address->id}}"
                                                   name="updateUserAddress"
                                                   onclick="getShippingCompany({{$address->id}})"
                                                   @if(session()->has('saved_customer_address_id'))
                                                   {{ session()->get('saved_customer_address_id') == $address->id ? 'checked' : '' }}
                                                   @endif
                                                   class="custom-control-input">
                                            <label class="custom-control-label"  for="updateUserAddress{{$address->id}}">
                                                <b>{{$address->address_title}}</b>
                                                <small id="address_subtitle{{$address->id}}">
                                                    {{$address->address}}<br>
                                                    {{$address->country->name}} - {{$address->state->name}}
                                                    - {{$address->city->name}}
                                                </small>

                                            </label>
                                        </div>
                                    </div>
                                        <hr>
                                    @empty
                                        <span>لا يوجد عناوين مسجلة</span>
                                    @endforelse
                                </div>
                                <hr>
                                <div class="setup_action" id="setup_02">
                                    <div class="d-flex justify-content-between justify-items-center mb-3">
                                        <div class="d-inline-flex">
                                            <div class="user-avatar bg-light">
                                                <span>2</span>
                                            </div>
                                            <div style="margin-right: 15px;">
                                                <span class="lead-text">{{trans('frontend.shipping company')}}</span>
                                                <span class="sub-text" id="setup_02_subtitle">-</span>
                                            </div>
                                        </div>
                                        <div class="d-flex  justify-content-center align-items-center ">
                                            {{--                                        <a href="#" class="btn btn-outline-primary">{{trans('frontend.edit')}}</a>--}}
                                        </div>
                                    </div>
                                </div>
                                <div id="shipping_company" style="display: none;">
                                    @if(session()->has('shipping_company'))
                                    @forelse(session()->get('shipping_company') as $company)
                                        <div class="pt-2" style="padding-right: 10px;">
                                            <div class="custom-control custom-radio">
                                                <input type="radio"
                                                       id="updateShippingCompany{{$company->id}}"
                                                       value="{{$company->id}}"
                                                       name="updateShippingCompany"
                                                       onclick="getShippingCost({{$company->id}})"
                                                       @if(session()->has('saved_shipping_company_id'))
                                                       {{ session()->get('saved_shipping_company_id') == $company->id ? 'checked' : '' }}
                                                       @endif
                                                       class="custom-control-input">
                                                <label class="custom-control-label"  for="updateShippingCompany{{$company->id}}">
                                                    <b>{{$company->name}}</b><br>
                                                    <small id="company_subtitle{{$company->id}}">
                                                        {{$company->description}} - ( {{$company->cost}} ر.س )
                                                    </small>

                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                    @empty
                                        <span>لا يوجد شركات متاحة مسجلة</span>
                                    @endforelse
                                    @endif
                                </div>
                                <hr>

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
        $(document).ready(function() {
            var id_address = $('#shipping_address').find('input[type="radio"]:checked').val();
            var id_company = $('#shipping_company').find('input[type="radio"]:checked').val();
            if (id_address != null)
            {
                $('#setup_01').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                $('#setup_01_subtitle').text($('#address_subtitle'+id_address).text())

            }else {
                $('#setup_01').find('.user-avatar').html('<span>1</span>').removeClass('bg-light')
                $('#shipping_address').slideToggle(100);
            }

            if (id_company != null)
            {
                if ($('#shipping_company').is(':visible')) {
                    $('#setup_02').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').removeClass('bg-light')
                }else {
                    $('#setup_02').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                }
                $('#setup_02_subtitle').text($('#company_subtitle'+id_company).text())

            }else {
                if ($('#shipping_company').is(':visible')) {
                    $('#setup_02').find('.user-avatar').html('<span>2</span>').removeClass('bg-light')
                }else {
                    $('#setup_02').find('.user-avatar').html('<span>2</span>').addClass('bg-light')
                }
                if (id_address != null){
                $('#shipping_company').slideToggle(100);
                }
            }

            $('#setup_01').on('click',function (){
                id_company = $('#shipping_company').find('input[type="radio"]:checked').val()
                $('#shipping_company').slideUp(100, function() {
                    if ($('#shipping_company').is(':visible')) {
                        $('#setup_02').find('.user-avatar').html('<span class="fs-14px">2</span>').removeClass('bg-light')
                    } else {
                        if (id_company != null)
                        {
                            $('#setup_02').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                        }else {
                            $('#setup_02').find('.user-avatar').html('<span>2</span>').addClass('bg-light')

                        }
                    }
                });

                $('#shipping_address').slideToggle(300, function() {
                    if ($('#shipping_address').is(':visible')) {
                    $('#setup_01').find('.user-avatar').html('<span class="fs-14px">1</span>').removeClass('bg-light')
                    } else {
                        if (id_address != null)
                        {
                            $('#setup_01').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                        }else {
                            $('#setup_01').find('.user-avatar').html('<span>1</span>').addClass('bg-light')

                        }
                    }
                });
                id_address = $('#shipping_address').find('input[type="radio"]:checked').val();


            });
            $('#setup_02').on('click',function (){
                id_address = $('#shipping_address').find('input[type="radio"]:checked').val();

                if (id_address != null){
                    $('#shipping_address').slideUp(100, function() {
                        if ($('#shipping_address').is(':visible')) {
                            $('#setup_01').find('.user-avatar').html('<span class="fs-14px">1</span>').removeClass('bg-light')
                        } else {
                            if (id_address != null)
                            {
                                $('#setup_01').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                            }else {
                                $('#setup_01').find('.user-avatar').html('<span>1</span>').addClass('bg-light')

                            }
                        }
                    });

                    $('#shipping_company').slideToggle(300, function() {
                        if ($('#shipping_company').is(':visible')) {
                            $('#setup_02').find('.user-avatar').html('<span class="fs-14px">2</span>').removeClass('bg-light')
                        } else {
                            if (id_company != null)
                            {
                                $('#setup_02').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                            }else {
                                $('#setup_02').find('.user-avatar').html('<span>2</span>').addClass('bg-light')

                            }
                        }
                    });
                }
                id_company = $('#shipping_company').find('input[type="radio"]:checked').val()
            });


            $('#shipping_address').find('input[type="radio"]').on('change', function() {
                if ($(this).is(':checked')) {
                    id_address = $('#shipping_address').find('input[type="radio"]:checked').val();

                    if (id_address != null){
                        $('#shipping_address').slideUp(200, function() {
                            if ($('#shipping_address').is(':visible')) {
                                $('#setup_01').find('.user-avatar').html('<span class="fs-14px">1</span>').removeClass('bg-light')
                            } else {
                                if (id_address != null)
                                {
                                    $('#setup_01').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                                }else {
                                    $('#setup_01').find('.user-avatar').html('<span>1</span>').addClass('bg-light')

                                }
                            }
                        });

                        $('#shipping_company').slideToggle(500, function() {
                            if ($('#shipping_company').is(':visible')) {
                                $('#setup_02').find('.user-avatar').html('<span class="fs-14px">2</span>').removeClass('bg-light')
                            } else {
                                if (id_company != null)
                                {
                                    $('#setup_02').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                                }else {
                                    $('#setup_02').find('.user-avatar').html('<span>2</span>').addClass('bg-light')

                                }
                            }
                        });
                    }
                    id_company = $('#shipping_company').find('input[type="radio"]:checked').val()
                }
            });



        });
    </script>
    <script>
        function getShippingCompany(id) {
            const csrf = "{{csrf_token()}}";

            $.ajax({
                type: 'post',
                url: "{{ route('frontend.getShippingCompany')}}",
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
                data: {
                    'id': id,
                },

                beforeSend: function () {
                },
                success: function (data) {
                    $(".shippingCompany").load(location.href + " .shippingCompany");
                    $(".refresh-cart-now").load(location.href + " .refresh-cart-now");
                    $('#setup_01_subtitle').text($('#address_subtitle'+id).text())
                    var id_address = $('#shipping_address').find('input[type="radio"]:checked').val();
                console.log(id_address);
                },
                error: function (response) {


                },
                complete: function (response) {

                    // $('#create_new'+id).html('save');
                }
            });
        }

        function getShippingCost(id) {
            const csrf = "{{csrf_token()}}";

            $.ajax({
                type: 'post',
                url: "{{ route('frontend.getShippingCost')}}",
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
                data: {
                    'id': id,
                },

                beforeSend: function () {
                },
                success: function (data) {
                    $(".refresh-cart-now").load(location.href + " .refresh-cart-now");
                    $('#setup_02_subtitle').text($('#company_subtitle'+id).text())

                    var id_company = $('#shipping_company').find('input[type="radio"]:checked').val();

                },
                error: function (response) {


                },
                complete: function (response) {

                    // $('#create_new'+id).html('save');
                }
            });
        }
    </script>

</body>

</html>
