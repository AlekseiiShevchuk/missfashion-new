@extends('layouts.front')
@section('title')
    {{$categoryName}}  | Missfashion Shop
@endsection
@section('content')

    @include('front.slider')

    <div class="container">
        <h1 class="page-header">{{$categoryName}}</h1>
    </div>

    @include('front.cats')

    <section class="section container">
        <div class="row text-center">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <a href="{{ action('FrontController@show', $product->id) }}">
                            <img class="thumbnail-img" src="{{asset($product->images()->first()->local_small_img)}}">
                        </a>
                        <div class="caption">
                            <h4 style="height: 38px;overflow: hidden;"><strong>{{ $product->name }}</strong></h4>
                            <p class="caption-description">{{ mb_substr($product->description, 0, 50) }} ... </p>
                            <div class="price">
                                @if($product->old_price && $product->new_price)
                                    <span class="text-danger"><strike>KR {{ $product->old_price }}</strike></span>
                                    <span class="text-primary"> KR {{$product->new_price}} </span>
                                @elseif($product->regular_price)
                                    <span class="text-primary"> KR {{$product->regular_price}} </span>
                                @endif
                            </div>
                            <p class="thumbnail-category"><storng>Category: </storng><a href="{{route('category',['category' =>$product->category->id])}}">{{ $product->category->name }}</a></p>
                            <hr>
                            <p>
                                <a href="{{ action('FrontController@show', $product->id) }}" class="btn btn-default">Mere Info</a>
                                <a href="{{ $referal_link_prefix . $product->source_url }}" class="btn btn-primary" style="padding-left:30px;padding-right:30px;">Bestil nu!</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
            <div class="row text-center">
                <div class="container"> {{ $products->links() }}</div>
            </div>
        </div>
    </section>
    @include('front.page-contents')
@endsection
