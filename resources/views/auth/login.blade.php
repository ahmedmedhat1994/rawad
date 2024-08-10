@extends('Frontend.layout.master')
@section('title')
    سلة التسوق
@endsection

@section('style')

@endsection

@section('content')

    <div class="nk-content">
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
                                            <li class="breadcrumb-item"><a href="{{route('login')}}">{{trans('frontend.login')}}</a></li>

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
                    <div class="card card-bordered">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Sign-In</h4>
                                    <div class="nk-block-des">
                                        <p>Access the Hayah Care panel using your email and passcode.</p>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="default-01">Email or Username</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input  class="form-control form-control-lg" id="email"  type="text" name="login"  required autofocus autocomplete="username">
                                    </div>
                                    @error('login')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Password</label>
                                        {{--                                            <a class="link link-primary link-sm" href="html/pages/auths/auth-reset-v2.html">Forgot Code?</a>--}}
                                    </div>
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-control-wrap">
                                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input  class="form-control form-control-lg" id="password"  type="password"
                                                name="password"
                                                required autocomplete="current-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                            </form>
                            {{--                                <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="html/pages/auths/auth-register-v2.html">Create an account</a>--}}
                        </div>
                        {{--                                <div class="text-center pt-4 pb-3">--}}
                        {{--                                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>--}}
                        {{--                                </div>--}}
                        {{--                                <ul class="nav justify-center gx-4">--}}
                        {{--                                    <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>--}}
                        {{--                                    <li class="nav-item"><a class="nav-link" href="#">Google</a></li>--}}
                        {{--                                </ul>--}}
                    </div>



                </div>

        </div>

    </div>
    </div>

@endsection

@section('script')



@endsection


