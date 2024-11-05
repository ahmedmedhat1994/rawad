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
.logo{
    max-height: 33px;
    max-width: 70px;
    width: 100%;
}
#payment_method {
    align-items: center;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: flex-start;
    margin: 0 0 20px;
    position: relative;
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
                                    <hr>

                                @endif
                                @if(session()->has('shipping'))
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="lead-text">تكلفة الشحن  </span>
                                        <span class="lead-text">{{session()->get('shipping')['cost']}} ر.س </span>
                                    </div>
                                    <hr>

                                @endif
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
                                        <a href="#addNewAddress" data-bs-toggle="modal" data-bs-target="#addNewAddress"  class="btn btn-outline-primary">{{trans('frontend.add new address')}}</a>
                                    </div>
                                </div>
                                </div>
                                <div id="shipping_address" style="display: none;">
                                    @forelse($data['user_addresses'] as $address)
                                        <hr>
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
                                <div  id="shipping_company" style="display: none;">
                                    @if(session()->has('shipping_company'))
                                        <div class="shipping_company">
                                    @forelse(session()->get('shipping_company') as $company)
                                            <hr>
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
                                                       class="custom-control-input ">
                                                <label class="custom-control-label"  for="updateShippingCompany{{$company->id}}">
                                                    <b>{{$company->name}}</b><br>
                                                    <small id="company_subtitle{{$company->id}}">
                                                        {{$company->description}} - ( {{$company->cost}} ر.س )
                                                    </small>

                                                </label>
                                            </div>
                                        </div>

                                    @empty
                                        <span>لا يوجد شركات متاحة مسجلة</span>
                                    @endforelse
                                        </div>
                                    @endif
                                </div>
                                <hr>
                                <div class="setup_action" id="setup_03">
                                    <div class="d-flex justify-content-between justify-items-center mb-3">
                                        <div class="d-inline-flex">
                                            <div class="user-avatar bg-light">
                                                <span>3</span>
                                            </div>
                                            <div style="margin-right: 15px;">
                                                <span class="lead-text">{{trans('frontend.payment method')}}</span>
                                                <span class="sub-text" id="setup_02_subtitle">-</span>
                                            </div>
                                        </div>
                                        <div class="d-flex  justify-content-center align-items-center ">
                                            {{--                                        <a href="#" class="btn btn-outline-primary">{{trans('frontend.edit')}}</a>--}}
                                        </div>
                                    </div>
                                </div>
                                <div  id="payment_method" style="display: none;">
                                    @if (session()->has('saved_customer_address_id')  && session()->has('saved_shipping_company_id'))
                                        @forelse($data['payment_methods'] as $payment_method)
                                            <hr>

                                            <div class="mt-2 border border-primary rounded p-3 " style="padding-right: 10px; display: block; position: relative; ">
                                                <div class="d-block justify-content-center justify-items-center text-center custom-control custom-radio">
                                                    <input type="radio"
                                                           id="payment-method-{{ $payment_method->id }}"
                                                           value="{{$payment_method->id}}"
                                                           name="updatePaymentMethod"
                                                           {{ session()->get('saved_payment_method_code') == $payment_method->code ? 'checked' : '' }}
                                                           onclick="updatePaymentMethod({{$payment_method->id}})"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label"  for="payment-method-{{ $payment_method->id }}">
                                                       {{$payment_method->name}}
                                                        <br>
                                                    </label>
                                                </div>
                                            </div>
                                        @empty
                                            <span>لا يوجد طرق دفع متاحة </span>
                                        @endforelse
                                    @endif
                                </div>

                                <div class="form-group Action_submit mx-5">
                                    <a  class="btn {{session()->has('saved_customer_address_id')  && session()->has('saved_shipping_company_id') && session()->has('saved_payment_method_id') ? 'btn-primary' : 'btn-gray' }}   btn-lg btn-block" href="javascript:void(0);" @if(session()->has('saved_customer_address_id')  && session()->has('saved_shipping_company_id') && session()->has('saved_payment_method_id')) onclick="event.preventDefault(); document.getElementById('action-form').submit();"  @endif   >إتمام الطلب</a>
                                </div>
                            </div>


                            @if (session()->has('saved_customer_address_id')  && session()->has('saved_shipping_company_id') && session()->has('saved_payment_method_id'))
                                    <form  action="{{ route('checkout.payment') }}" method="post" id="action-form" class="d-none">
                                        @csrf
                                        <input type="hidden" name="customer_address_id" value="{{ old('customer_address_id', session()->get('saved_customer_address_id') ) }}" class="form-control">
                                        <input type="hidden" name="shipping_company_id" value="{{ old('shipping_company_id', session()->get('saved_shipping_company_id')) }}" class="form-control">
                                        <input type="hidden" name="payment_method_id" value="{{ old('payment_method_id', session()->get('saved_payment_method_id')) }}" class="form-control">

                                    </form>
                            @endif
                        </div>

                    </div>



            </div>

        </div>


        <!-- content @e -->
        <!-- footer @s -->



        <!-- footer @e -->
    </div>
    <!-- wrap @e -->
</div>
<!-- app-root @e -->
    <div class="modal fade modal-lg" id="addNewAddress">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('customers.create new customer address')}}</h5>
                    <a href="" class="close" data-bs-dismiss="modal"
                       aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{route('customer_addresses.store')}}" method="post"
                          class="form-validate is-alter" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-gs pb-3">
                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ old('user_id', \Illuminate\Support\Facades\Auth::id()) }}" readonly>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="country_id">{{trans('customers.country')}}</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2"  id="country_id" name="country_id" data-search="on" >
                                            <option value="0" disabled selected>----- {{trans('customers.select country')}}-----</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{ old('country_id') == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="state_id">{{trans('customers.city')}}</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" name="state_id" id="state_id" data-minimum-results-for-search="Infinity">

                                        </select>
                                        @error('state_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="state_id">{{trans('customers.state')}}</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" name="city_id" id="city_id" data-minimum-results-for-search="Infinity">

                                        </select>
                                        @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address">{{trans('customers.street')}} </label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="address" name="address"
                                               value="{{ old('address')}}">
                                        @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address">{{trans('customers.street details')}} </label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="address2" name="address2"
                                               value="{{ old('address2')}}">
                                        @error('address2')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">{{trans('categories.save')}}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


<!-- JavaScript -->
@include('Frontend.layout.script')
@yield('script')
    <script src="{{asset('backend/js/typehead/bootstrap3-typeahead.min.js')}}">
    </script>
    <script>

        $(document).ready(function() {
            var id_address = $('#shipping_address').find('input[type="radio"]:checked').val();
            var id_company = $('#shipping_company').find('input[type="radio"]:checked').val();
            var id_payment = $('#payment_method').find('input[type="radio"]:checked').val();
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
            if (id_payment != null)
            {
                if ($('#payment_method').is(':visible')) {
                    $('#setup_03').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').removeClass('bg-light')
                }else {
                    $('#setup_03').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                }
                // $('#setup_03_subtitle').text($('#company_subtitle'+id_payment).text())

            }else {
                if ($('#payment_method').is(':visible')) {
                    $('#setup_03').find('.user-avatar').html('<span>3</span>').removeClass('bg-light')
                }else {
                    $('#setup_03').find('.user-avatar').html('<span>3</span>').addClass('bg-light')
                }
                if (id_address != null){
                    $('#payment_method').slideToggle(100);
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

                    $('#payment_method').slideUp(300, function() {
                        if ($('#payment_method').is(':visible')) {
                            $('#setup_03').find('.user-avatar').html('<span class="fs-14px">3</span>').removeClass('bg-light')
                        } else {
                            if (id_payment != null)
                            {
                                $('#setup_03').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                            }else {
                                $('#setup_03').find('.user-avatar').html('<span>3</span>').addClass('bg-light')

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


                        $('#payment_method').slideUp(300, function() {
                            if ($('#payment_method').is(':visible')) {
                                $('#setup_03').find('.user-avatar').html('<span class="fs-14px">3</span>').removeClass('bg-light')
                            } else {
                                if (id_payment != null)
                                {
                                    $('#setup_03').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                                }else {
                                    $('#setup_03').find('.user-avatar').html('<span>3</span>').addClass('bg-light')

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
            $('#setup_03').on('click',function (){
                id_payment = $('#payment_method').find('input[type="radio"]:checked').val();



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

                    $('#shipping_company').slideUp(200, function() {
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



                $('#payment_method').slideToggle(300, function() {
                    if ($('#payment_method').is(':visible')) {
                        $('#setup_03').find('.user-avatar').html('<span class="fs-14px">3</span>').removeClass('bg-light')
                    } else {
                        if (id_payment != null)
                        {
                            $('#setup_03').find('.user-avatar').html('<span><em class="icon ni ni-check-thick"></em></span>').addClass('bg-light')
                        }else {
                            $('#setup_03').find('.user-avatar').html('<span>3</span>').addClass('bg-light')

                        }
                    }
                });
                id_payment = $('#payment_method').find('input[type="radio"]:checked').val();

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
                    $(".shipping_company").load(location.href + " .shipping_company");
                    $(".refresh-cart-now").load(location.href + " .refresh-cart-now");
                    $('#setup_01_subtitle').text($('#address_subtitle'+id).text())
                    $(".Action_submit").load(location.href + " .Action_submit");

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
        function updatePaymentMethod(id) {
            const csrf = "{{csrf_token()}}";

            $.ajax({
                type: 'post',
                url: "{{ route('frontend.updatePaymentMethod')}}",
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
                data: {
                    'id': id,
                },

                beforeSend: function () {
                },
                success: function (data) {
                    $(".Action_submit").load(location.href + " .Action_submit");


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
                    $(".Action_submit").load(location.href + " .Action_submit");

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


    <script>

        $(document).ready(function() {
            $('#country_id').select2();
            $('#state_id').select2();
            $('#city_id').select2();
        });


        $(function () {


            populateStates();
            populateCities();


            $("#country_id").change(function () {
                populateStates();
                populateCities();
                return false;
            });

            $("#state_id").change(function () {
                populateCities();
                return false;
            });

            function populateStates()
            {
                let countryIdVal = $('#country_id').val() != null ? $('#country_id').val() : '{{ old('country_id') }}';
                $.get("{{ route('states.get_states') }}", {country_id: countryIdVal}, function (data) {
                    $('option', $("#state_id")).remove();
                    $("#state_id").append($('<option disabled selected></option>').val('').html('{{trans('customers.select city')}}'));
                    $.each(data, function (val, text) {
                        let selectedVal = text.id == '{{ old('state_id') }}' ? "selected" : "";
                        $("#state_id").append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                }, "json");
            }

            function populateCities()
            {
                let stateIdVal = $('#state_id').val() != null ? $('#state_id').val() : '{{ old('state_id') }}';
                $.get("{{ route('cities.get_cities') }}", {state_id: stateIdVal}, function (data) {
                    $('option', $("#city_id")).remove();
                    $("#city_id").append($('<option disabled selected></option>').val('').html('{{trans('customers.select state')}}'));
                    $.each(data, function (val, text) {
                        let selectedVal = text.id == '{{ old('city_id') }}' ? "selected" : "";
                        $("#city_id").append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                }, "json");
            }


        });
    </script>
</body>

</html>
