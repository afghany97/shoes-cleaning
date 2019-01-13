<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/mine.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

</head>

<body>

<div id="app">

    <nav class="navbar navbar-default">

        <div class="container-fluid container">

            <!-- Brand and toggle get grouped for better mobile display -->

            {{--logo--}}

            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"

                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="{{route('home')}}">Brighto <i class="fas fa-broom"></i></a>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                @if(auth()->check())

                    <ul class="nav navbar-nav">

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"

                               aria-expanded="false">تصفح <span class="caret"></span></a>

                            <ul class="dropdown-menu">

                                <li><a href="{{route('orders')}}">الاوامر</a></li>

                                {{--<li><a href="{{route('suppliers')}}">Suppliers</a></li>--}}

                                {{--<li><a href="{{route('products')}}">Products</a></li>--}}

                                {{--<li><a href="{{route('lockers')}}">Lockers</a></li>--}}

                                <li><a href="{{route('expenses.index')}}">المصروفات</a></li>

                                {{--<li role="separator" class="divider"></li>--}}

                                {{--<li><a href="#">Separated link</a></li>--}}

                                {{--<li role="separator" class="divider"></li>--}}

                                {{--<li><a href="#">One more separated link</a></li>--}}

                            </ul>

                        </li>

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"

                               aria-expanded="false">جديد <span class="caret"></span></a>

                            <ul class="dropdown-menu">

                                <li><a href="{{route('order.create')}}">أمر</a></li>

                                <li><a href="{{route('shoes.create')}}">نوع حذاء</a></li>

                                {{--<li><a href="{{route('supplier.create')}}">Supplier</a></li>--}}

                                {{--<li><a href="{{route('product.create')}}">Product</a></li>--}}

                                {{--<li><a href="{{route('locker.create')}}">Locker</a></li>--}}

                                <li><a href="{{route('expenses.create')}}">مصروفات</a></li>

                            </ul>

                        </li>

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"

                               aria-expanded="false">استخراج<span class="caret"></span></a>

                            <ul class="dropdown-menu">

                                <li><a href="{{route('orders.export.excel')}}">Excel</a></li>

                            </ul>

                        </li>
                    </ul>

                @endif

                {{--right side --}}

                <ul class="nav navbar-nav navbar-right">

                    @if(auth()->check())

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"


                               aria-expanded="false">{{auth()->user()->name}} <span class="caret"></span></a>

                            <ul class="dropdown-menu">

                                <li>

                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        تسجيل الخروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                </li>

                            </ul>


                        </li>

                    @elseif (auth()->guest())

                        <li><a href="{{ route('login') }}">تسجيل الدخول </a></li>

                        <li><a href="{{ route('register') }}">انشاء حساب</a></li>

                    @endif

                </ul>

            </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->

    </nav>

    @if($errors->any())

        <div class="alert alert-danger text-center w-50 mx-auto m-b-10">

            {{$errors->first()}}

        </div>

    @endif

    @if(session('success'))

        <div class="alert alert-success text-center w-50 mx-auto m-b-10">

            {{session('success')}}

        </div>

    @endif

    @yield('content')

</div>

<!-- Scripts -->

<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('js/jquery.js') }}"></script>

@yield('js')

</body>

</html>
