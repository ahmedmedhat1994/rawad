@extends('Frontend.layout.master')
@section('title')
    الصفحة الرئيسية
@endsection

@section('style')

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
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>

@endsection

@section('script')



@endsection


