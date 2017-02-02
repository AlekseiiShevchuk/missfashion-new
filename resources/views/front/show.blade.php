@extends('layouts.front')

@section('content')

    <main class="product-full">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="product-slider">
                        @foreach($product->images as $item)
                            <div>
                                <img src="/{{$item->local_big_img}}" style="width: 100%;" alt="Image {{ $item->id }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="product-slider-thumb">
                        @foreach($product->images as $item)
                            <div class="slide-thumb">
                                <img src="/{{$item->local_small_img}}" style="width: 100%;" alt="Thumb image {{ $item->id }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="product-info">
                        <h1>{{ $product->name }}</h1>
                        <div class="price">
                            <span class="text-primary"> USD {{$product->new_price}} </span>
                            <span class="text-danger"><strike>USD {{ $product->old_price }}</strike></span>
                        </div>
                        <hr>
                        <p>{{ $product->description }}</p>
                        <a href="{{ $product->source_url }}" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="product-tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-1" role="tab" data-toggle="tab">Additional Information</a></li>
                        <li role="presentation"><a href="#tab-2" role="tab" data-toggle="tab">Reviews</a></li>
                        <li role="presentation"><a href="#tab-3" role="tab" data-toggle="tab">Levering & Retur</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab-1">
                            <h3>Additional Information</h3>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab-2">
                            <h3>Reviews</h3>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab-3">
                            <h3>Levering & Retur</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-products">
            <div class="container">
                <h3 class="page-header">Related Products</h3>
                <div class="row text-center">
                    @foreach($products as $product)
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img src="/{{$product->images()->first()->local_small_img}}">
                                <div class="caption">
                                    <h4 style="height: 38px;overflow: hidden;"><strong>{{ $product->name }}</strong></h4>
                                    <p>{{ mb_substr($product->description, 0, 55) }} ... </p>
                                    <div class="price">
                                        <span class="text-primary"> USD {{$product->new_price}} </span>
                                        <span class="text-danger"><strike>USD {{ $product->old_price }}</strike></span>
                                    </div>
                                    <hr>
                                    <p>
                                        <a href="{{ action('FrontController@show', $product->id) }}" class="btn btn-primary">Buy Now!</a> <a href="{{ action('FrontController@show', $product->id) }}" class="btn btn-default">More Info</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

@endsection