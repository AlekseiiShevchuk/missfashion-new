<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3>Lorem</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, sunt!</p>
            </div>
            {{--<div class="col-md-offset-1 col-md-3">--}}
                {{--<ul class="nav nav-pills nav-stacked">--}}
                    {{--<li><a href="#">One</a></li>--}}
                    {{--<li><a href="#">Two</a></li>--}}
                    {{--<li><a href="#">Three</a></li>--}}
                    {{--<li><a href="#">Four</a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            <div class="col-md-offset-4 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($categories as $key => $value)
                        <li><a href="{{route('main')}}?cat={{$key}}">{{$value}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>