<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @if(Gate::allows('manager'))
                <a class="navbar-brand" href="{{ route('manager.home') }}">
                    {{ __('app.home') }}
                </a>
                <a class="navbar-brand" href="{{ route('manager.autoparks.index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a class="navbar-brand" href="{{ route('manager.cars.index') }}">
                    {{ __('car.cars') }}
                </a>
                @endif
                @if(Gate::allows('driver'))
                <a class="navbar-brand" href="{{ route('cars.index') }}">
                    {{ __('car.cars') }}
                </a>
                @endif
                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    @php
                    $currentLocale = LaravelLocalization::getCurrentLocale();
                    $locales = LaravelLocalization::getSupportedLocales();
                    $otherLocales = getOtherLocales($currentLocale, $locales);
                    @endphp
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                   class="nav-link dropdown-toggle"
                                   href="#" role="button"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('auth.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="btn dropdown-toggle nav-link d-flex align-items-center py-0"
                                   id="dropdownMenuButton"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                   href="#">
                                    <img src="{{ getPathToLocaleFlag($currentLocale) }}"
                                         alt="{{ getNativeLanguageName($currentLocale) }}"
                                         class="mr-1"
                                         width="24">
                                        {{ getNativeLanguageName($currentLocale) }}
                                </a>
                                <div class="dropdown-menu border-white" aria-labelledby="dropdownMenuButton">
                                @foreach($otherLocales as $localeCode => ['native' => $language])
                                    <a rel="alternate"
                                       class="dropdown-item d-flex align-items-center pl-2 py-0"
                                       hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        <img src="{{ getPathToLocaleFlag($localeCode) }}"
                                             alt="{{ normalizeNativeLanguageName($language) }}"
                                             class="mr-1"
                                             width="24">
                                        {{ normalizeNativeLanguageName($language) }}
                                    </a>
                                 @endforeach
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
