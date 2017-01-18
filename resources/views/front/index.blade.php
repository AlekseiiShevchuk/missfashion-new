@extends('layouts.front')

@section('content')
    @include('front.slider')
<div class="row column text-center">
    <h2>Our Newest Products</h2>
    <hr>
</div>
<div class="row small-up-2 large-up-4">

    @foreach($products as $product)
        <div class="column">
            <img class="thumbnail" src="{{$product->images()->first()->url}}">
            <h5>{{$product->name}}</h5>
            <p>{{$product->regular_price}} </p>
            <a href="{{$product->source_url}}" class="button expanded">Buy</a>
        </div>
    @endforeach
    <div class="row"></div>
        <div class="text-center">{{ $products->links() }}</div>

</div>
<hr>
<div class="row column">
    <div class="callout primary">
        <h3>Really big special this week on items.</h3>
    </div>
</div>
<hr>
<div class="row column text-center">
    <h2>Some Other Neat Products</h2>
    <hr>
</div>
<div class="row small-up-2 medium-up-3 large-up-6">
    <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button small expanded hollow">Buy</a>
    </div>
    <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button small expanded hollow">Buy</a>
    </div>
    <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button small expanded hollow">Buy</a>
    </div>
    <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button small expanded hollow">Buy</a>
    </div>
    <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button small expanded hollow">Buy</a>
    </div>
    <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button small expanded hollow">Buy</a>
    </div>
</div>
<hr>
<div class="row">
    <div class="medium-4 columns">
        <h4>Top Products</h4>
        <div class="media-object">
            <div class="media-object-section">
                <img class="thumbnail" src="http://placehold.it/100x100">
            </div>
            <div class="media-object-section">
                <h5>Nunc Eu Ullamcorper Orci</h5>
                <p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque.</p>
            </div>
        </div>
        <div class="media-object">
            <div class="media-object-section">
                <img class="thumbnail" src="http://placehold.it/100x100">
            </div>
            <div class="media-object-section">
                <h5>Nunc Eu Ullamcorper Orci</h5>
                <p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque.</p>
            </div>
        </div>
        <div class="media-object">
            <div class="media-object-section">
                <img class="thumbnail" src="http://placehold.it/100x100">
            </div>
            <div class="media-object-section">
                <h5>Nunc Eu Ullamcorper Orci</h5>
                <p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque.</p>
            </div>
        </div>
    </div>
    <div class="medium-4 columns">
        <h4>Top Products</h4>
        <div class="media-object">
            <div class="media-object-section">
                <img class="thumbnail" src="http://placehold.it/100x100">
            </div>
            <div class="media-object-section">
                <h5>Nunc Eu Ullamcorper Orci</h5>
                <p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque.</p>
            </div>
        </div>
        <div class="media-object">
            <div class="media-object-section">
                <img class="thumbnail" src="http://placehold.it/100x100">
            </div>
            <div class="media-object-section">
                <h5>Nunc Eu Ullamcorper Orci</h5>
                <p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque.</p>
            </div>
        </div>
        <div class="media-object">
            <div class="media-object-section">
                <img class="thumbnail" src="http://placehold.it/100x100">
            </div>
            <div class="media-object-section">
                <h5>Nunc Eu Ullamcorper Orci</h5>
                <p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque.</p>
            </div>
        </div>
    </div>
    <div class="medium-4 columns">
        <h4>Top Products</h4>
        <div class="media-object">
            <div class="media-object-section">
                <img class="thumbnail" src="http://placehold.it/100x100">
            </div>
            <div class="media-object-section">
                <h5>Nunc Eu Ullamcorper Orci</h5>
                <p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque.</p>
            </div>
        </div>
        <div class="media-object">
            <div class="media-object-section">
                <img class="thumbnail" src="http://placehold.it/100x100">
            </div>
            <div class="media-object-section">
                <h5>Nunc Eu Ullamcorper Orci</h5>
                <p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque.</p>
            </div>
        </div>
        <div class="media-object">
            <div class="media-object-section">
                <img class="thumbnail" src="http://placehold.it/100x100">
            </div>
            <div class="media-object-section">
                <h5>Nunc Eu Ullamcorper Orci</h5>
                <p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque.</p>
            </div>
        </div>
    </div>
</div>
@endsection