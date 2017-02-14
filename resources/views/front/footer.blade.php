<!-- FOOTER -->
<footer class="footer">
    <div class="footer__top">
    <div class="container">
        <div class="row">
            <div class="col-md-3 text-center">
                <h3 class="footer__title">LOGO</h3>
                <p class="footer__contacts">
                    MissFashion,<br>
                    Smedeland 7, st. <br>
                    2600 Glostrup <br>
                    Email: <a href="mailto:Info@MissFashion.dk">Info@MissFashion.dk</a> <br>
                    Web: <a href="#">MissFashion.dk</a> <br>
                </p>
                <div class="social-icons">
                    <a href="" class="social-icons__link">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="" class="social-icons__link">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="" class="social-icons__link">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <h4 class="footer__title">TOP RATED PRODUCTS</h4>
                @foreach($rated_products as $rated_product)
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading"><a href="{{ action('FrontController@show', $rated_product->id) }}">{{ $rated_product->name }}</a></h4>
                        <p><strong>KR {{$product->new_price}}</strong></p>
                    </div>
                    <div class="media-right">
                        <a href="{{ action('FrontController@show', $rated_product->id) }}">
                            <img class="media-object" src="/{{ $rated_product->images()->first()->local_small_img }}" alt="{{ $rated_product->name }}" width="64px" height="64px">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-3">
                <h4 class="footer__title">Product Categories</h4>
                    @foreach($categories as $key => $value)
                        <a class="label label-primary" style="padding:10px;display:inline-block;margin:0 5px 5px 0;" href="{{route('main')}}?cat={{$key}}">{{$value}}</a>
                    @endforeach
            </div>
        </div>
    </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
                <div class="footer__copy text-center">
                    <div>© Copyright 2012 -&nbsp;<script>document.write(new Date().getFullYear());</script>2017&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;All Rights Reserved&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<p style="margin-top: 10px;"><img src="https://avada.theme-fusion.com/classic-shop/wp-content/uploads/sites/48/2015/09/payment_cards_footer.png" alt="logo_footer" width="322" height="34" class=""></p></div>
                </div>
        </div>
    </div>
</footer>