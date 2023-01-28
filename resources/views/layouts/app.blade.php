<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/theme.min.css') }}">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if (auth()->check() && auth()->user()->role->name == 'Patient')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('my.bookings') }}">{{ __('My Bookings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('my.prescriptions') }}">{{ __('My Prescriptions') }}</a>
                            </li>
                        @endif
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (auth()->check() && auth()->user()->role->name == 'Patient')
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            {{ __('Dashboard') }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        $( function() {
          $("#datepicker").datepicker({ 
                dateFormat: 'yy-mm-dd',
                showButtonPanel: true,
                numberOfMonths: 2,
                minDate: new Date()
            });
        } );
    </script>

    <style>
        body {
            background: #fff;
        }
        .ui-corner-all {
            background: red;
            color: #fff;
        }
        label.btn {
            padding: 0;
        }
        label.btn input {
            opacity: 0;
            position: absolute;
        }
        label.btn span {
            text-align: center;
            padding: 6px 12px;
            display: block;
            min-width: 80px;
        }
        label.btn input:checked+span {
            background-color: rgb(80, 110, 228)
        }
   

        .continued {
    margin-top: -30px;
}

        .chat {
  width: 90%;
  border: solid 1px #EEE;
  display: flex;
  flex-direction: column;
  padding: 10px;
  float:left;
overflow-y: auto;
height: 500px;
box-shadow: 0px 8px 10px rgb(0 0 0 / 20%);

}

.messages {
  margin-top: -5px;
  display: flex;
  flex-direction: column;
}

.message {
  border-radius: 20px;
  padding: 8px 15px;
  margin-top: 5px;
  margin-bottom: 5px;
  display: inline-block;
}

.mine {
  align-items: flex-end;
}

.mine .message {
  color: white;
  margin-left: 25%;
  background: linear-gradient(to bottom, #00D0EA 0%, #0085D1 100%);
  background-attachment: fixed;
  position: relative;
}

.mine .message.last:before {
  content: "";
  position: absolute;
  z-index: 0;
  bottom: 0;
  right: -8px;
  height: 20px;
  width: 20px;
  background: linear-gradient(to bottom, #00D0EA 0%, #0085D1 100%);
  background-attachment: fixed;
  border-bottom-left-radius: 15px;
}

.mine .message.last:after {
  content: "";
  position: absolute;
  z-index: 1;
  bottom: 0;
  right: -10px;
  width: 10px;
  height: 20px;
  background: white;
  border-bottom-left-radius: 10px;
}

.yours {
  align-items: flex-start;
}

.yours .message {
  margin-right: 25%;
  background-color: #eee;
  position: relative;
}

.yours .message.last:before {
  content: "";
  position: absolute;
  z-index: 0;
  bottom: 0;
  left: -7px;
  height: 20px;
  width: 20px;
  background: #eee;
  border-bottom-right-radius: 15px;
}
.yours .message.last:after {
  content: "";
  position: absolute;
  z-index: 1;
  bottom: 0;
  left: -10px;
  width: 10px;
  height: 20px;
  background: white;
  border-bottom-right-radius: 10px;
}
.discussions {
    /* padding: 9px; */
    width: 101%;
    height: 533px;
    box-shadow: 0px 8px 10px rgb(0 0 0 / 20%);
    overflow: hidden;
    /* background-color: #87a3ec; */
    display: inline-block;
}

.discussions .discussion {
  width: 100%;
  height: 90px;
  background-color: #FAFAFA;
  border-bottom: solid 1px #E0E0E0;
  display:flex;
  align-items: center;
  cursor: pointer;
}

.discussions .search {
  display:flex;
  align-items: center;
  justify-content: center;
  color: #E0E0E0;
}

.discussions .search .searchbar {
  height: 40px;
  background-color: #FFF;
  width: 70%;
  padding: 0 20px;
  border-radius: 50px;
  border: 1px solid #EEEEEE;
  display:flex;
  align-items: center;
  cursor: pointer;
}

.discussions .search .searchbar input {
  margin-left: 15px;
  height:38px;
  width:100%;
  border:none;
  font-family: 'Montserrat', sans-serif;;
}

.discussions .search .searchbar *::-webkit-input-placeholder {
    color: #E0E0E0;
}
.discussions .search .searchbar input *:-moz-placeholder {
    color: #E0E0E0;
}
.discussions .search .searchbar input *::-moz-placeholder {
    color: #E0E0E0;
}
.discussions .search .searchbar input *:-ms-input-placeholder {
    color: #E0E0E0;
}

.discussions .message1-active {
  width: 98.5%;
  height: 90px;
  background-color: #FFF;
  border-bottom: solid 1px #E0E0E0;
}

.discussions .discussion .photo {
    margin-left:20px;
    display: block;
    width: 45px;
    height: 45px;
    background: #E6E7ED;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.online {
  position: relative;
  top: 30px;
  left: 35px;
  width: 13px;
  height: 13px;
  background-color: #8BC34A;
  border-radius: 13px;
  border: 3px solid #FAFAFA;
}

.desc-contact {
  height: 43px;
  width:50%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.discussions .discussion .name {
  margin: 0 0 0 20px;
  font-family:'Montserrat', sans-serif; 
  font-size: 11pt;
  color:#515151;
}
 
.discussions .discussion .message1 {
  margin: 6px 0 0 20px;
  font-family:'Montserrat', sans-serif;
  font-size: 9pt;
  color:#515151;
}
.input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 90%;
    box-shadow: 0px 8px 10px rgb(0 0 0 / 20%);

}
</style>
</body>
</html>
