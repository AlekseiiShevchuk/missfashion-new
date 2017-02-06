<header>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Missfashion</a>
            </div>
            <div class="collapse navbar-collapse" id="collapse-1">
                @if(count($categories) <= 7 )
                <ul class="nav navbar-nav navbar-right" id="main-menu">
                    @foreach($categories as $key => $value)
                        <li><a  href="{{route('main')}}/?cat={{$key}}">{{$value}}</a></li>
                    @endforeach
                </ul>
                @else
                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $key => $value)
                                <li><a  href="{{route('main')}}/?cat={{$key}}">{{$value}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</header>