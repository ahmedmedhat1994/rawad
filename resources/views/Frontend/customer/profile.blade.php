@extends('Frontend.layout.master')
@section('title')
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
                                            <li class="breadcrumb-item"><a href="{{route('customer.profile')}}">{{trans('frontend.my profile')}}</a></li>
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
                                <div class="row g-gs">
                                    <div class="col-md-3">
                                        <ul class="nav link-list-menu border border-light rounded m-0" role="tablist">
                                            <li>
                                                <a class="" data-bs-toggle="tab" href="#tabItem10" aria-selected="false" role="tab" tabindex="-1"><em class="icon ni ni-bell"></em><span>{{trans('frontend.notifications')}}</span></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tab" href="#tabItem20" aria-selected="false" role="tab" class="" tabindex="-1"><em class="icon ni ni-archived"></em><span>{{trans('frontend.orders')}}</span></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tab" href="#tabItem30" aria-selected="false" role="tab" class="" tabindex="-1"><em class="icon ni ni-cart"></em><span>{{trans('frontend.Orders wait Paid')}}</span></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tab" href="#tabItem40" aria-selected="true" role="tab" class=""><em class="icon ni ni-star"></em><span>{{trans('frontend.favorite')}}</span></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tab" href="#tabItem50" aria-selected="true" role="tab" class="active"><em class="icon ni ni-user"></em><span>{{trans('frontend.my profile')}}</span></a>
                                            </li>
                                            <li><a class="text-danger" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><em class="icon ni ni-signout text-danger"></em><span>{{trans('frontend.sign out')}}</span></a></li>
                                            <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                                                @csrf
                                            </form>
                                        </ul>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="tab-content">
                                            <div class="tab-pane" id="tabItem10" role="tabpanel">


                                            </div>

                                            <div class="tab-pane" id="tabItem20" role="tabpanel">

                                                @if(count(auth()->user()->orders) > 0)
                                                    <div class="row g-gs mb-4 shopping-summery" >
                                                        <div class="col-lg-12">
                                                            @foreach(auth()->user()->orders as $order)
                                                                <div class="card ">
                                                                    <div class="card-inner p-0">
                                                                        <div class="nk-tb-list nk-tb-ulist">
                                                                            <div class="nk-tb-item nk-tb-head">
                                                                                <div class="nk-tb-col"><span class="sub-text">{{trans('frontend.order no')}}</span></div>
                                                                                <div class="nk-tb-col tb-col-sm"><span class="sub-text">{{trans('frontend.total')}}</span></div>
                                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">{{trans('frontend.data')}}</span></div>
                                                                                <div class="nk-tb-col tb-col-lg"><span class="sub-text">{{trans('frontend.order status')}}</span></div>
                                                                            </div><!-- .nk-tb-item -->
                                                                            <div class="nk-tb-item">
                                                                                <div class="nk-tb-col tb-col-sm">
                                                                                    <span class="sub-text">{{$order->ref_id }}</span>
                                                                                </div>
                                                                                <div class="nk-tb-col tb-col-md">
                                                                                    <span class="sub-text">{{$order->currency() . ' ' . $order->total}}</span>
                                                                                </div>
                                                                                <div class="nk-tb-col tb-col-lg">
                                                                                    <span class="sub-text">{{$order->created_at->format('d-m-Y')}}</span>

                                                                                </div>
                                                                                <div class="nk-tb-col tb-col-md">
                                                                                    {!! $order->statusWithLabel() !!}
                                                                                </div>
                                                                            </div><!-- .nk-tb-item -->

                                                                        </div><!-- .nk-tb-list -->
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="text-center" style="padding: 50px">
                                                        <div>
                                                            <img src="{{asset('backend/images/empty.png')}}">

                                                        </div>
                                                        <div>
                                                            <a><span>لايوجد طلبات سابقة</span></a>

                                                        </div>
                                                        <a href="{{route('frontend.index')}}" class="btn btn-primary btn-lg mt-4 ">عودة للرئيسية</a>

                                                    </div>
                                            @endif
                                            </div>
                                            <div class="tab-pane" id="tabItem30" role="tabpanel">

                                                @if(count(auth()->user()->orders->where('order_status',2)) > 0 )
                                                    <div class="row g-gs mb-4 shopping-summery" >
                                                        <div class="col-lg-12">
                                                            @foreach(auth()->user()->orders->where('order_status',2) as $order)
                                                                <div class="card ">
                                                                    <div class="card-inner p-0">
                                                                        <div class="nk-tb-list nk-tb-ulist">
                                                                            <div class="nk-tb-item nk-tb-head">
                                                                                <div class="nk-tb-col"><span class="sub-text">{{trans('frontend.order no')}}</span></div>
                                                                                <div class="nk-tb-col tb-col-sm"><span class="sub-text">{{trans('frontend.total')}}</span></div>
                                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">{{trans('frontend.data')}}</span></div>
                                                                                <div class="nk-tb-col tb-col-lg"><span class="sub-text">{{trans('frontend.order status')}}</span></div>
                                                                            </div><!-- .nk-tb-item -->
                                                                            <div class="nk-tb-item">
                                                                                <div class="nk-tb-col tb-col-sm">
                                                                                    <span class="sub-text">{{$order->ref_id }}</span>
                                                                                </div>
                                                                                <div class="nk-tb-col tb-col-md">
                                                                                    <span class="sub-text">{{$order->currency() . ' ' . $order->total}}</span>
                                                                                </div>
                                                                                <div class="nk-tb-col tb-col-lg">
                                                                                    <span class="sub-text">{{$order->created_at->format('d-m-Y')}}</span>

                                                                                </div>
                                                                                <div class="nk-tb-col tb-col-md">
                                                                                    {!! $order->statusWithLabel() !!}
                                                                                </div>
                                                                            </div><!-- .nk-tb-item -->

                                                                        </div><!-- .nk-tb-list -->
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="text-center" style="padding: 50px">
                                                        <div>
                                                            <img src="{{asset('backend/images/empty.png')}}">

                                                        </div>
                                                        <div>
                                                            <a><span>لايوجد طلبات </span></a>

                                                        </div>
                                                        <a href="{{route('frontend.index')}}" class="btn btn-primary btn-lg mt-4 ">عودة للرئيسية</a>

                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tab-pane" id="tabItem40" role="tabpanel">
                                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                                                <p>Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.</p>
                                            </div>
                                            <div class="tab-pane active show" id="tabItem50" role="tabpanel">
                                                <form action="{{ route('customer.update_profile') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                                    @csrf
                                                    @method('patch')
                                                <div class="card h-100">
                                                    <div class="card-inner">
                                                        <div class="card-head">
                                                            <h5 class="card-title">{{trans('frontend.my profile')}}</h5>
                                                        </div>
                                                        <form action="#">
                                                            <div class="form-group">
                                                                <label class="form-label" for="full-name">{{trans('frontend.first name')}}</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control form-control-lg" name="first_name" type="text" value="{{ old('first_name', auth()->user()->first_name) }}" placeholder="Enter your first name">
                                                                    @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">{{trans('frontend.last name')}}</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control form-control-lg" name="last_name" type="text" value="{{ old('last_name', auth()->user()->last_name) }}" placeholder="Enter your last name">
                                                                    @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="phone-no">{{trans('frontend.email')}}</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control form-control-lg" name="email" type="text" value="{{ old('email', auth()->user()->email) }}" placeholder="e.g. Jason@example.com">
                                                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="pay-amount">{{trans('frontend.mobile')}}</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control form-control-lg" name="mobile" type="text"  value="{{ old('mobile', auth()->user()->mobile) }}" placeholder="e.g. 966512345678">
                                                                    @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group d-flex align-content-center  text-center ">
                                                                <button type="submit" class="btn btn-lg btn-primary   text-center w-100 ">{{trans('frontend.save')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .nk-block -->

                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')


@endsection


