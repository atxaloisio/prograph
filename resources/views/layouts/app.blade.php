<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Modulo Administrativo') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">        
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
        <link href="{{asset('css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('css/main.css')}}" rel="stylesheet">
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('css/local.css')}}" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="{{asset('js/html5shiv.js')}}"></script>
        <script src="{{asset('js/respond.min.js')}}"></script>
        <![endif]-->          
        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
            ]) !!}
            ;
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
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
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <label class="navbar-brand">&nbsp;&nbsp;|&nbsp;</label>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->                       
                        <ul class="nav navbar-nav">                        
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="Cadastros">Cadastros<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#" target="_self" title="Shop">Categorias</a>
                                    </li>
                                    <li>
                                        <a href="/admin/produtos" target="_self" title="Shop">Produtos</a>
                                    </li>
                                    <li>
                                        <a href="#" target="_self" title="Shop">Promoções</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" target="_self" title="Shop">Loja</a>
                            </li>
                            <li>
                                <a href="#" target="_self" title="Sobre">Catálogo</a>
                            </li>
                            <li>
                                <a href="#" target="_self" title="Contatos">Contato</a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('js/price-range.js')}}"></script>
        <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('js/jquery.mlens-1.6.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/local.js') }}"></script>
    </body>
</html>
