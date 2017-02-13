<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 text-center">
                <h3>LOGO</h3>
                <p>
                    MissFashion,<br>
                    Smedeland 7, st. <br>
                    2600 Glostrup <br>
                    Email: <a href="mailto:Info@MissFashion.dk">Info@MissFashion.dk</a> <br>
                    Web: <a href="#">MissFashion.dk</a> <br>
                </p>
            </div>
            <div class="col-md-3">
                <h4>TOP RATED PRODUCTS</h4>
                @foreach($rated_products as $rated_product)
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">{{ $rated_product->name }}</h4>
                        <div class="price">
                            <span class="text-danger"><strike>KR {{ $product->old_price }}</strike></span>
                            <span class="text-primary"> KR {{$product->new_price}} </span>
                        </div>
                    </div>
                    <div class="media-right">
                        <a href="#">
                            <img class="media-object" src="/{{ $rated_product->images()->first()->local_small_img }}" alt="{{ $rated_product->name }}" width="64px" height="64px">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($categories as $key => $value)
                        <li><a href="{{route('main')}}?cat={{$key}}">{{$value}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>