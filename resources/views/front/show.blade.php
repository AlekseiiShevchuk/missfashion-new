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
                    <div class="product-info section">
                        <h1>{{ $product->name }}</h1>
                        <p>Varenummer: {{ $product->sku }}</p>
                        <div class="price">
                            <span class="text-primary"> KR {{$product->new_price}} </span>
                            <span class="text-danger"><strike>KR {{ $product->old_price }}</strike></span>
                        </div>
                        <hr>
                        <p>{{ $product->description }}</p>
                        <a href="{{ $product->source_url }}" class="btn btn-primary">Buy</a>
                    </div>
                    <div class="extra-product-information">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            STØRRELSESGUIDE
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel">
                                    <div class="panel-body">
                                        {!! $product->first_accordion_content !!}
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                            LEVERING & RETUR
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel">
                                    <div class="panel-body">
                                        {!! $product->second_accordion_content !!}
                                    </div>
                                </div>
                            </div>
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
                                        <span class="text-danger"><strike>KR {{ $product->old_price }}</strike></span>
                                        <span class="text-primary"> KR {{$product->new_price}} </span>
                                    </div>
                                    <hr>
                                    <p>
                                        <a href="{{ action('FrontController@show', $product->id) }}" class="btn btn-default">More Info</a>
                                        <a href="{{ action('FrontController@show', $product->id) }}" class="btn btn-primary">Buy Now!</a>
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