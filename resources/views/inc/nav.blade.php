<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">{{ trans('Home') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/cart') }}">{{ trans('Cart') }}</a>
            </li>
            @if (session('auth'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/products') }}">{{ trans('Products') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/orders') }}">{{ trans('Orders') }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/login') }}">{{ trans('Login') }}</a>
                </li>
            @endif
        </ul>

        @if (session('auth'))
            <form action="{{ url('/logout') }}" method="post" class="form-inline my-2 my-lg-0">
                @csrf
                <input type="submit" value="{{ trans('Logout') }}" class="btn btn-danger">
            </form>
        @endif
    </div>
</nav>
