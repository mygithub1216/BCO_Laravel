
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The association for, and by shippers - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    @yield('css')
    @if(Request::is( Config::get('chatter.routes.home') ) || Request::is( Config::get('chatter.routes.home') . '/*' ))
        <!-- LINK TO YOUR CUSTOM STYLESHEET -->
        <link rel="stylesheet" href="/css/forums.css" />
    @endif

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    
</head>
<body>
    <div id="app">
        {{-- <div class="app-header container hidden-xs">
            <a href="{{ url('/') }}"><img class="pull-left" src="{{ url('/res/logo-1.png') }}" /></a>
            <h2 class="pull-right">BCO Shippers Association</h2>
        </div> --}}
        <nav class="navbar navbar-default navbar-fixed-top">
            <a href="/" class="hidden-xs"><img class="pull-left" style="max-height: 60px; margin: 10px;" src="{{ url('/res/logo-2.png') }}" /></a>
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand visible-xs" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::guest()) 
                            <li><a href="/who-we-are">Who We Are</a></li>
                            <li><a href="/why-join">Why Join</a></li>
                            <li><a href="/non-profit-status">Non Profit Status</a></li>
                            <li><a href="/shippingrates">Shipping Rates</a></li>
                            <li><a href="/board">Board</a></li>
                            <li><a href="/contact-us">Contact Us</a></li>
                        @else
                            <li calss="navbar-text"><a href="{{ url('/members') }}">Members Area</a></li>
                            <li><a href="{{ url('/members/news') }}">News</a></li>
                            <li><a href="{{ url('/members/forums') }}">PowerGRID</a></li>
                            <li><a href="{{ url('/members/rates') }}">Shipping Rates</a></li>
                            <li><a href="{{ url('/members/software') }}">Software</a></li>
                            <li><a href="{{ url('/members/directory') }}">Directory</a></li>
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}"><strong class="primary highlight">Sign Up Today</strong></a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <?php $noti_count= count(Auth::user()->unreadNotifications);  ?>
                                    @if($noti_count > 0) 
                                        <span class="badge">{{ $noti_count }}</span>
                                    @endif
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('users/'.Auth::user()->id.'/edit') }}"><i class="fa fa-id-badge" aria-hidden="true"></i> Your Profile</a></li>

                                    @if(Auth::user()->is_subscribed())
                                    <li><a href="{{ url('subscriptions/'.Auth::user()->id.'/edit') }}"><i class="fa fa-credit-card" aria-hidden="true"></i> Your Subscription</a></li>
                                    @endif

                                    <li><a href="{{ url('users/privacy/'.Auth::user()->id) }}"><i class="fa fa-shield" aria-hidden="true"></i> Privacy Settings</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ url('users/inbox/'.Auth::user()->id) }}"><i class="fa fa-inbox" aria-hidden="true"></i> Inbox @if($noti_count > 0) 
                                        <span class="badge">{{ $noti_count }}</span>
                                    @endif</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
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
            </div>
        </nav>
        <div id="content">
            @yield('content')
        </div>
    </div>
    {{-- @if(!Request::is('members/rates*'))
    <footer layout="row">

        <div class="container">
        
            <ul>
                <li>Copyright &copy; 2016. All rights reserved.</li>
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Site Map</a></li>
                <li class="pull-right">Hosting and Maintenance by QWYK</li>

            </ul>
        </div>

    </footer>
    @endif --}}

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    @yield('js')
</body>
</html>