<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ComS319Anime</title>

        <! -- Stylesheets -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('/owl-carousel/owl.theme.css') }}">

        <!-- Fonts -->
        <link href="//fonts.googleapis.com/css?family=Roboto:700,500,400,300,100" rel="stylesheet" type="text/css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <style>
            html, body{ background:#292929; }
            .content {

                width: 960px;
                background: #1A1A1A;
                height: auto;
                margin: 70px auto;

            }

            .node {
                font: 10px sans-serif;
                fill: #ccc;
                stroke: #000;
                fixed: false;

            }

            .link {
                stroke: #777;
                stroke-width: 2px;
            }

            #box {
                background: purple;
                color: snow;
                width: 500px;
                height: 100px;
                padding: 10px;
            }
            #label {
                background: snow;
                color: black;

            }
            .class{
                float: left;

            }
            #left{
                float:left;
            }
        </style>
    </head>
    <body>
        <div class="ui grid">
            <div class="ui fluid fixed five item top attached stackable borderless menu" style="background:#1DB5F4; height:50px;
                margin:0px auto">
                <div class="item" style="padding:10px 50px">
                    <a href="/" style="color:white">Home</a>
                </div>
                <div class="item" style="padding:10px 50px">
                    <a href="{{route('anime.index')}}" style="color:white">List of Animes</a>
                </div>
                <div class="item" style="padding:10px 50px">
                    <a href="{{route('user.index')}}" style="color:white">Users</a>
                </div>
                <div class="item" style="padding:10px 50px">
                    @if (Auth::guest())
                        <a href="{{url('/auth/register')}}" style="color:white">Create Account</a>
                    @else
                        <a href="{{route('user.show', Auth::user()->id)}}" style="color:white">My Profile</a>
                    @endif
                </div>
                <div class="item" style="padding:10px 50px">
                    @if (Auth::guest())
                        <a href="{{url('/auth/login')}}" style="color:white">Login</a>
                    @else
                        <div class="ui inline pointing dropdown link">
                            <div class="text" style="color:white">
                                {{ Auth::user()->name }}
                            </div>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <a class="item" href="{{ route('user.edit', Auth::user()->id) }}">
                                    <i class="edit icon"></i>Edit Profile
                                </a>
                                <a class="item" href="{{ route('user.changePassword', Auth::user()->id) }}">
                                    <i class="lock icon"></i>Change Password
                                </a>
                                <a class="item" href="{{ url('/auth/logout') }}">
                                    <i class="sign out icon"></i> Logout
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="ui page grid main">
            <div class="content">
                @if( count( $errors ) > 0 )
                    <div class="ui container">
                        <div class="ui error message">
                            <i class="close icon"></i>
                            <div class="header">
                                Something went wrong!
                            </div>
                            <ul class="list">
                                @foreach( $errors->all() as $errors )
                                    <li>{{ $errors }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if( session( 'success' ) )
                    <div class="ui container">
                        <div class="ui positive message" >
                            <i class="close icon"></i>
                            {{ session( 'success' ) }}
                        </div>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src='http://d3js.org/d3.v3.min.js'></script>
        <script src="//oss.maxcdn.com/semantic-ui/2.1.3/semantic.min.js"></script>
        <script>
            $(document).ready(function ()
            {

                $('.ui.accordion').accordion();
                $('.ui.dropdown').dropdown();
                $('.ui.checkbox').checkbox();

            });
        </script>
        <script type="text/javascript" src="{{ asset('/js/init.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/owl-carousel/owl.carousel.js') }}"></script>
    </body>
</html>

