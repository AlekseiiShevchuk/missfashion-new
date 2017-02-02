@extends('layouts.front')

@section('content')

    @include('front.slider')

    @include('front.cats')

    <section class="container">
        <div class="row text-center">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{$product->images()->first()->local_small_img}}">
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
            <div class="row text-center">{{ $products->links() }}</div>
        </div>
    </section>

@endsection