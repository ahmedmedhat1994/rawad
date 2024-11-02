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
        .top-navbar {
            display: flex;
            min-height: 48px;
            padding-top: .5rem;
            padding-bottom: .5rem;
        }

        .swal2-popup.swal2-toast .swal2-icon {
            direction: ltr !important;
        }
    </style>
</head>

<body class="nk-body bg-lighter has-rtl">
<div class="nk-app-root">
    <!-- wrap @s -->
    <div class="nk-wrap">
        <!-- main header @s -->
            <!-- main header @s -->
            @include('Frontend.layout.header')

            <!-- main header @e -->
            <!-- content @s -->
            @yield('content')

            <!-- content @e -->
            <!-- footer @s -->



            <div class="nk-footer bg-white" id="footer">
                <div class="container py-5 py-md-7">
                    <div class="row g-gs ">
                        <div class="col-lg-3 col-md-9 px-5">
                            <div class="widget widget-about">
                                <a href="html/index.html" class="lead-text-lg mb-2">رواد الزى | RAWAD ZAY</a>
                                <span class="sub-text mb-3">شركة رواد الزى للزي الموحد هي أكثر من مجرد شركة . نحن علامة تجارية للملابس المهنية والمدرسية والرسمية تتميز بجودة منتجاتها وخبرة طويلة في مجال صناعة الزي الموحد.
                        </span>
                                <ul class="social social-primary mb-3 ">
                                    <li><a href="#"><em class="icon ni ni-facebook-f text-black"></em></a></li>
                                    <li><a href="#"><em class="icon ni ni-instagram text-black"></em></a></li>
                                    <li><a href="#"><em class="icon ni ni-twitter text-black"></em></a></li>
                                </ul>
                                <div class="d-flex">
                                    <a>
                                        <img width="40px" src="{{asset('frontend/payment/vat.png')}}">
                                    </a>
                                    <div style="margin-right: 10px;">
                                        <p class="lead-text text-sm text-text-grey mb-1">الرقم الضريبي</p>
                                        <b class="text-sm"><tcxspan tcxhref="302278989700003" title="Call 302278989700003 via 3CX">302278989700003</tcxspan></b>
                                    </div>
                                </div>
                            </div><!-- .widget -->
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-8 px-5">
                            <div class="widget">
                                <h6 class="widget-title">تواصل معنا</h6>
                                <ul class="widget-contact row gx-gs">
                                    <li class="col-mb-6 col-lg-12"><em class="icon ni ni-whatsapp text-black"></em><a href="#"> +96605000000</a></li>
                                    <li class="col-mb-6 col-lg-12"><em class="icon ni ni-mobile text-black"></em><a href="#"> +96605000000</a></li>
                                    <li class="col-mb-6 col-lg-12"><em class="icon ni ni-mail text-black"></em><a href="#"> info@rawadzay.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                <div class="nk-footer-wrap">
                    <div class="nk-footer-copyright mb-3"> &copy; الحقوق محفوظة | {{\Carbon\Carbon::now()->format('Y')}} رواد الزي | Rawad Zey
                    </div>
                    <div class="nk-footer-links">
                        <ul class="nav nav-sm">
                            <li class="nav-item">
                                <a data-bs-toggle="modal" href="#region" class="nav-link"><img src="{{asset('frontend/payment/mada.png')}}" width="50px"></a>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="modal" href="#region" class="nav-link"><img src="{{asset('frontend/payment/visa.png')}}" width="50px"></a>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="modal" href="#region" class="nav-link"><img src="{{asset('frontend/payment/apply.png')}}" width="50px"></a>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="modal" href="#region" class="nav-link"><img src="{{asset('frontend/payment/tabby.png')}}" width="50px"></a>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="modal" href="#region" class="nav-link"><img src="{{asset('frontend/payment/tamara.png')}}" width="50px"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer @e -->
    </div>
    <!-- wrap @e -->
</div>
<!-- app-root @e -->

<!-- Modal login Code -->
<div class="modal fade" tabindex="-1" id="loginModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Login with Phone</h5>
            </div>
            <div class="modal-body">
                <!-- نموذج إرسال كود OTP -->
                <form id="otp-form">
                    @csrf
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone" required placeholder="Enter your phone number">
                        <div id="phoneError" class="alert alert-danger mt-2" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block" onclick="sendOTP()">Send OTP</button>
                    </div>
                </form>

                <!-- نموذج تأكيد OTP -->
                <form id="verify-otp-form" style="display: none;">
                    @csrf
                    <div class="form-group">
                        <label for="otp" class="form-label">OTP Code</label>
                        <input type="text" class="form-control" name="otp" id="otp" required placeholder="Enter OTP code">
                        <div id="otpError" class="alert alert-danger mt-2" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-block" onclick="verifyOTP()">Verify & Login</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div><!-- JavaScript -->
@include('Frontend.layout.script')
@yield('script')
<link rel="stylesheet" href="{{asset('backend/css/editors/summernote.css')}}">

<script src="{{asset('backend/js/libs/editors/summernote.js')}}"></script>

<script src="{{asset('backend/js/editors.js')}}"></script>
<!-- كود JavaScript لإرسال الطلب باستخدام AJAX -->
<script>

    document.addEventListener('DOMContentLoaded', function () {
        @if (session('showLoginModal'))
        // عرض المودال تلقائيًا إذا كانت الجلسة تشير لذلك
        $('#loginModal').modal('show');
        @endif
    });


    // دالة لإرسال كود OTP باستخدام AJAX
    function sendOTP() {
        const phone = document.getElementById('phone').value;
        const token = document.querySelector('input[name="_token"]').value;

        fetch("{{ route('send.otp') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": token
            },
            body: JSON.stringify({ phone: phone })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('otp-form').style.display = 'none';
                    document.getElementById('verify-otp-form').style.display = 'block';
                } else {
                    displayError('phoneError', data.message || 'Failed to send OTP. Please try again.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // دالة للتحقق من كود OTP باستخدام AJAX
    function verifyOTP() {
        const otp = document.getElementById('otp').value;
        const token = document.querySelector('input[name="_token"]').value;

        fetch("{{ route('verify.otp') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": token
            },
            body: JSON.stringify({ otp: otp })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // إعادة تحميل الصفحة الحالية بعد النجاح
                } else {
                    displayError('otpError', data.message || 'Invalid OTP. Please try again.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // دالة لعرض الأخطاء
    function displayError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        errorElement.style.display = 'block';
        errorElement.innerText = message;
    }

    @if ($errors->any())
    $('#loginModal').modal('show');
    @endif
</script>


</body>

</html>
