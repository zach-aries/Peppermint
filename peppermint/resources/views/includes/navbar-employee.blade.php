<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header" style="margin-left: 15px" >
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Peppermint
            </a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else

                <li class="dropdown" style="width: 160px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Account <span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>