@foreach($products as $product)
    <div class="col-6 col-md-3">
        <div class="card card-bordered " style="border-radius: .75rem;">
            <div class="product-thumb" >
                <a href="{{route('frontend.product',$product->slug)}}">
                    <img class="card-img-top" src="{{asset('uploads/products/'.$product->firstMedia->filename)}}" alt="">
                </a>
                <ul class="product-badges">
                    <li class="d-flex justify-content-start"><span class="badge badge-sm badge-dim fs-4 bg-danger">{{trans('frontend.New')}}</span></li>
                </ul>

            </div>
            <div class="card-inner text-center">
                <h6 class="product-title"><a href="{{route('frontend.product',$product->slug)}}">{{$product->name}}</a></h6>
                @if(isset($product->sale_price)&& $product->sale_price > 0 )
                    <div class="product-price text-primary h6" ><small class="text-muted del fs-13px">{{$product->price}}  ر.س</small> {{$product->sale_price}} ر.س</div>
                @else
                    <div class="product-price text-primary h6" >{{$product->price}}  ر.س</div>
                @endif
                <input type="hidden" id="price{{$product->id}}" value="{{(isset($product->sale_price) && $product->sale_price > 0  ? $product->sale_price : $product->price)}}">
                <a href="javascript:void(0)" id="add_to_cart{{$product->id}}" onclick="addToCart({{$product->id}})" class="btn  btn-dim btn-lg btn-outline-secondary btn-action mt-2"><em class="icon ni ni-bag"></em><span>{{trans('frontend.Add to cart')}}</span></a>

            </div>
        </div>
    </div><!-- .col -->
@endforeach
