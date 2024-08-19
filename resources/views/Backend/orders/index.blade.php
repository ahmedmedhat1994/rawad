@extends('Backend.layout.master')
@section('title')
    {{trans('page_title.orders')}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">{{trans('page_title.orders')}}</h3>
                        <div class="nk-block-des text-soft">
                            <p>{{trans('products.You have total')}} {{$orders->count()}} {{trans('page_title.orders')}}</p>
                        </div>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <div class="toggle-expand-content" data-content="pageMenu">

                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card card-stretch">
                    <div class="card-inner-group">
                        @if($orders->count() > 0)
                            <div class="card-inner position-relative card-tools-toggle">
                                <div class="card-title-group">
                                    <div class="card-tools me-n1">
                                        <ul class="btn-toolbar gx-1">
                                            <li>
                                                <a href="#" class="btn btn-icon search-toggle toggle-search"
                                                   data-target="search"><em class="icon ni ni-search"></em></a>
                                            </li><!-- li -->
                                            <li class="btn-toolbar-sep"></li><!-- li -->
                                            <li>

                                            </li><!-- li -->
                                        </ul><!-- .btn-toolbar -->
                                    </div><!-- .card-tools -->
                                </div><!-- .card-title-group -->
                                <div class="card-search search-wrap" data-search="search">
                                    <div class="card-body">
                                        <div class="search-content">
                                            <a href="#" class="search-back btn btn-icon toggle-search"
                                               data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                            <input type="text" class="form-control border-transparent form-focus-none"
                                                   id="search" placeholder="Search by user or email">
                                            <button class="search-submit btn btn-icon"><em
                                                    class="icon ni ni-search"></em></button>
                                        </div>
                                    </div>
                                </div><!-- .card-search -->
                            </div><!-- .card-inner -->
                            <div class="card-inner p-0">
                                <div class="nk-tb-list nk-tb-ulist date_request">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="select_all custom-control-input" id="uid">
                                                <label class="custom-control-label" for="uid"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col"><span>{{trans('products.ref id')}}</span></div>
                                        <div class="nk-tb-col"><span>{{trans('products.user')}}</span></div>
                                        <div class="nk-tb-col"><span>{{trans('products.payment method')}}</span></div>
                                        <div class="nk-tb-col"><span>{{trans('products.amount')}}</span></div>
                                        <div class="nk-tb-col"><span>{{trans('products.status')}}</span></div>
                                        <div class="nk-tb-col"><span>{{trans('products.create')}}</span></div>
                                        <div class="nk-tb-col"><span>{{trans('products.Actions')}}</span></div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach($orders as $order)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="select_all custom-control-input"
                                                           value="{{$order->id}}}" id="uid{{$order->id}}">
                                                    <label class="custom-control-label"
                                                           for="uid{{$order->id}}"></label>
                                                </div>
                                            </div>


                                            <div class="nk-tb-col">
                                                @ability('admin','update_orders')
                                                <a href="{{route('admin.orders.edit',$order->id)}}">
                                                    @endability

                                                    <span class="tb-amount" id="name_delete">{{$order->ref_id}}</span>
                                                </a>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{$order->user->full_name}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-amount" id="name_delete">{{$order->payment_method->name}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-amount" id="name_delete">{{$order->currency() . $order->total}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                {!! $order->statusWithLabel() !!}
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{ $order->created_at->format('Y-m-d h:i a') }}</span>
                                            </div>


                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    @ability('admin','update_orders')

                                                    <li class="nk-tb-action-hidden">
                                                        <a href="{{route('admin.orders.show',$order->id)}}"
                                                           class="btn btn-trigger btn-icon">
                                                            <em class="icon ni ni-edit" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{trans('page_title.edit')}}"></em>
                                                        </a>
                                                    </li>
                                                    @endability

                                                    {{--                                                    <li class="nk-tb-action-hidden">--}}
                                                    {{--                                                        <a href="{{route('admin.products.show',$product->id)}}" class="btn btn-trigger btn-icon" >--}}
                                                    {{--                                                            <em class="icon ni ni-eye" data-bs-toggle="tooltip" data-bs-placement="top" title="{{trans('page_title.view')}}"></em>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </li>--}}
                                                    @ability('admin','delete_orders')

                                                    <li class="nk-tb-action-hidden">
                                                        <a href="javascript:void(0)"
                                                           onclick="deleteType({{$order->id}})"
                                                           class="btn btn-trigger btn-icon">
                                                            <em class="icon ni ni-delete" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{trans('page_title.delete')}}"></em>
                                                        </a>
                                                    </li>
                                                    @endability

                                                </ul>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                    @endforeach
                                </div><!-- .nk-tb-list -->
                            </div><!-- .card-inner -->
                            <div class="p-3">
                                {!! $orders->appends(request()->all())->links() !!}

                            </div>

                        @else
                            <div class="card-inner p-0">
                                <div class="text-center" style="padding: 50px">
                                    <div>
                                        <img src="{{asset('backend/images/empty.png')}}">

                                    </div>
                                    <div>
                                        <a><span>{{trans('products.No Products Info Found')}}</span></a>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div><!-- .card-inner-group -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>

@endsection
@section('script')
    <script>


        function deleteType(id) {

            var name = $('#name_delete').text();

            Swal.fire({
                title: '{{trans('products.Delete!')}}',
                text: '{{trans('products.Are you sure to delete')}}' + "(" + name + ")?",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: '{{trans('products.cancel')}}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '{{trans('products.ok')}}'
            }).then((result) => {
                if (result.isConfirmed) {
                    // $('#file'+id).hide();
                    $.get('admin/orders/delete/' + id, function (deleted) {

                        if (deleted.exists == true) {
                            toastr.clear();
                            NioApp.Toast('<h5>{{trans('products.success')}}</h5><p>{{trans('products.product deleted successfully')}}</p>', 'success', {position: 'top-center'});
                            location.reload();
                            // setInterval('location.reload()', 1000);
                        } else {


                        }

                    })


                }
            })


        }
    </script>

@endsection
