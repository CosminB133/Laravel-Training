<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">@lang('Home')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart') }}">@lang('Cart')</a>
            </li>
            @if (session('auth'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products') }}">@lang('Products')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders') }}">@lang('Orders')</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">@lang('Login')</a>
                </li>
            @endif
        </ul>

        @if (session('auth'))
            <form action="{{ route('logout') }}" method="post" class="form-inline my-2 my-lg-0">
                @csrf
                <input type="submit" value="@lang('Logout')" class="btn btn-danger">
            </form>
        @endif
    </div>
</nav>
