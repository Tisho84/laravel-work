<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
                @if(Auth::user())
                    @if(Auth::user()->is_admin)
                        <li><a href="{{ url('users') }}">Users</a></li>
                        <li>{!! Html::link( route('categories.index'), 'Categories' ) !!}</li>
                    @else
                        <li>
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                Categories<span class="caret"></span></a>
                            @if(count($nav_categories) > 0)
                                <ul class="dropdown-menu">
                                    @foreach($nav_categories as $category)
                                        <li>{!! Html::link( route('categories.show', [$category->id]), $category->name ) !!}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                    <li>{!! Html::link( route('products.index'), 'Products') !!}</li>
                    <li>{!! Html::link( route('orders.index'), 'Orders') !!}</li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="//www.gravatar.com/avatar/{{md5(Auth::user()->email)}}}?s=30" class="img-circle">
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('viewProfile') }}">Profile</a></li>
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>