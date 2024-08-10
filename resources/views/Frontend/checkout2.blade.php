<!DOCTYPE html>
<html class="no-js" lang="ar" dir="rtl">

<head>
    @include('Frontend.layout2.head')
    <style>
        body {
            background-color: white !important;

        }
    </style>
</head>

<body>
<section class="mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-info-head">
                    <div class="card-body">
                        <div class="card-inner">
                            <div class="user-card">
                                <div class="user-avatar sq lg">
                                    <img src="{{asset('frontend/imgs/theme/logo.svg')}}" alt="">
                                </div>
                                <div class="user-info">
                                    <span
                                        class="lead-text fs-19px fw-300">مرحباً بك,{{\Illuminate\Support\Facades\Auth::user()->full_name}}</span>
                                    <nav>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a class="fs-15px fw-300"
                                                                           href="{{route('frontend.index')}}">{{trans('frontend.home')}}</a>
                                            </li>
                                            <li class="breadcrumb-item"><a class="fs-15px fw-300"
                                                                           href="{{route('frontend.cart')}}">{{trans('frontend.cart')}}</a>
                                            </li>
                                            <li class="breadcrumb-item active fs-15px fw-300">{{trans('frontend.checkout')}}</li>
                                        </ul>
                                    </nav>
                                </div>
                            </div><!-- .user-card -->
                        </div>
                        <div class="card-inner">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td class="fw-300 fs-19px">ملخص السلة</td>
                                            <td>{{$data['cart_subtotal']*1}} ر.س</td>
                                        </tr>
                                        <tr>
                                            <td class="">
                                                <span class="fw-500 fs-19px">كوبون </span>
                                                @if(session()->has('coupon'))
                                                    <span
                                                        class="text-danger">( {{session()->get('coupon')['code']}} )</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(session()->has('coupon'))
                                                    <span class="text-danger">- {{session()->get('coupon')['discount']}} ر.س </span>
                                                @else
                                                    <span>0.00</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @if(session()->has('shipping'))
                                            <tr>
                                                <td class="">
                                                    <span class="fw-500 fs-19px">تكلفة الشحن </span>
                                                </td>
                                                <td>
                                                    <span class="fw-600 fs-14px">{{session()->get('shipping')['cost']}} ر.س </span>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="fw-600 fs-22px">
                                                <span>اجمالى الطلب</span>
                                                @if(session()->has('coupon'))
                                                    <br>
                                                    <span class="badge badge-md badge-dim bg-success fs-14px fw-medium">🎉 رائع! لقد وفّرت {{session()->get('coupon')['discount']}} ر.س </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fw-600 fs-22px">{{$data['cart_total']}} ر.س  </span>

                                            </td>
                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="accordion-item">
                            <a href="#" class="accordion-head" data-bs-toggle="collapse"
                               data-bs-target="#accordion-item-2-1">
                                <h6 class="title">عنوان الشحن</h6>
                                <span class="accordion-icon"></span>
                            </a>
                            <div class="payment_option" dir="ltr">
                                @forelse($data['user_addresses'] as $address)
                                    <div class="custom-control custome-radio m-3">
                                        <input type="radio" id="updateUserAddress{{$address->id}}"
                                               value="{{$address->id}}"
                                               name="updateUserAddress"
                                               onclick="getShippingCompany({{$address->id}})"
                                               @if(session()->has('saved_customer_address_id'))
                                                   {{ session()->get('saved_customer_address_id') == $address->id ? 'checked' : '' }}
                                               @endif
                                               class="form-check-input">
                                        <label class="form-check-label" for="updateUserAddress{{$address->id}}">
                                            <b>{{$address->address_title}}</b>
                                            <small>
                                                {{$address->address}}<br>
                                                {{$address->country->name}} - {{$address->state->name}}
                                                - {{$address->city->name}}
                                            </small>
                                        </label>
                                    </div>
                                @empty
                                    <span>لا يوجد عناوين مسجلة</span>
                                @endforelse
                            </div>

                        </div>
                        @if(session()->has('saved_customer_address_id'))
                            <div class="accordion-item">
                                <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse"
                                   data-bs-target="#accordion-item-2-2">
                                    <h6 class="title">شركات الشحن</h6>
                                    <span class="accordion-icon"></span>
                                </a>
                                <div class="accordion-body collapse" id="accordion-item-2-2"
                                     data-bs-parent="#accordion-2">
                                    <div class="accordion-inner shippingCompany">
                                        @forelse(session()->get('shipping_company') as $company)
                                            <div class="custom-control custom-radio m-3">
                                                <input type="radio" id="updateShippingCompany{{$company->id}}"
                                                       value="{{$company->id}}"
                                                       name="updateShippingCompany"
                                                       onclick="getShippingCost({{$company->id}})"
                                                       @if(session()->has('saved_shipping_company_id'))
                                                           {{ session()->get('saved_shipping_company_id') == $company->id ? 'checked' : '' }}
                                                       @endif
                                                       class="custom-control-input">
                                                <label class="custom-control-label"
                                                       for="updateShippingCompany{{$company->id}}">
                                                    <b>{{$company->name}}</b><br>
                                                    <small>
                                                        {{$company->description}} - ( {{$company->cost}} ر.س )
                                                    </small>

                                                </label>
                                            </div>
                                        @empty
                                            <span>لا يوجد شركات متاحة مسجلة</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


@include('Frontend.layout2.script')


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
                $(".card-info-head").load(location.href + " .card-info-head");

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
                $(".card-info-head").load(location.href + " .card-info-head");
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
