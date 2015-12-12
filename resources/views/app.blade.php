<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ComS319Anime</title>

        <! -- Stylesheets -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('/owl-carousel/owl.theme.css') }}">

        <!-- Fonts -->
        <link href="//fonts.googleapis.com/css?family=Roboto:700,500,400,300,100" rel="stylesheet" type="text/css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src='http://d3js.org/d3.v3.min.js'></script>
        <!--<script type="text/javascript" src="{{ asset('/js/init.js') }}"></script>-->
        <script type="text/javascript" src="{{ asset('/owl-carousel/owl.carousel.js') }}"></script>

        <style>
            html, body{ background:#292929; }
            .content {

                width: 960px;
                background: #1A1A1A;
                height: auto;
                margin: 70px auto;

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
                <script>
                    function parse( button )
                    {

                        var splitString = document.getElementById( 'command').value.split( " " );
                        var startUrl = "http://localhost:8080/";
                        //var token = '{{ csrf_token() }}';
                        if( splitString[0].localeCompare( "goto" ) == 0 )
                        {

                            if( splitString[1].localeCompare( "user" ) == 0 )
                            {

                                var userId = splitString[2];
                                $.post( '{{ url('/user/{id}/checkUser') }}', { _token: $( 'meta[ name = csrf-token ]').attr( 'content' ), id: userId } ).done( function( data ){
                                    if( data.message == 0 )
                                    {

                                        window.location.href = startUrl + "user/" + userId;

                                    }
                                    else
                                    {

                                        alert( "This user does not exist" );

                                    }
                                }).fail( function( data ){
                                    //alert( data.message );
                                    if( data.message != 0 )
                                    {

                                        alert( "This user does not exist" );

                                    }
                                    else
                                    {

                                        window.location.href = startUrl + "user/" + userId;

                                    }

                                });

                            }
                            else if( splitString[1].localeCompare( "anime" ) == 0 )
                            {

                                var animeId = splitString[2];
                                $.post( '{{ url('/anime/{id}/checkAnime') }}', { _token: $( 'meta[ name = csrf-token ]').attr( 'content' ), id: animeId } ).done( function( data ){
                                    if( data.message == 0 )
                                    {

                                        window.location.href = startUrl + "anime/" + animeId;

                                    }
                                    else
                                    {

                                        alert( "This anime does not exist" );

                                    }
                                }).fail( function( data ){
                                    //alert( data.message );
                                    if( data.message != 0 )
                                    {

                                        alert( "This anime does not exist" );

                                    }
                                    else
                                    {

                                        window.location.href = startUrl + "anime/" + animeId;

                                    }

                                });

                            }
                            else if( splitString[1].localeCompare( "home" ) == 0 )
                            {

                                window.location.href = startUrl;

                            }
                            else if( splitString[1].localeCompare( "create" ) == 0 )
                            {

                                window.location.href = startUrl + "auth/register";

                            }
                            else if( splitString[1].localeCompare( "login" ) == 0 )
                            {

                                window.location.href = startUrl + "auth/login";

                            }
                            else if( splitString[1].localeCompare( "userHome" ) == 0 )
                            {

                                window.location.href = startUrl + "/user";

                            }
                            else if( splitString[1].localeCompare( "animeHome" ) == 0 )
                            {

                                window.location.href = startUrl + "/anime";

                            }
                            else
                            {

                                alert( "Invalid inner command" );

                            }

                        }
                        else if( splitString[0].localeCompare( "Login" ) == 0 )
                        {

                            var userEmail = splitString[1];
                            var userPassword = splitString[2];
                            //alert( "loggin in with email: " + userEmail + " and password: " + userPassword );
                            $.post( '{{ url('/auth/login') }}', { _token: $( 'meta[ name = csrf-token ]').attr( 'content' ), email: userEmail, password: userPassword } ).done( function( data ){
                                alert( "You are logged in!!" );
                                window.location.href = startUrl;
                            }).fail( function(){
                                alert( "Something went wrong" );
                            });

                        }
                        else if( splitString[0].localeCompare( "Logout" ) == 0 )
                        {

                            //alert( "Loging out" );
                            $.post( '{{ url('/auth/logout') }}', { _token: $( 'meta[ name = csrf-token ]').attr( 'content' ) } ).done( function( data ){
                                alert( data );
                                alert( "You are logged out" );
                                window.location.href = startUrl;
                            }).fail( function(){
                                alert( "Could not log you out" );
                            });

                        }
                        else
                        {

                            alert( "Invalid command" );

                        }

                    }
                </script>
                <br>
                <label style="color:white">Command Line</label>
                <br>
                <div class="ui fluid input">
                    <input type="text" name="commandLine" placeholder="Command" id="command" >
                </div>
                <br>
                <div>
                    <button type="submit" class="ui button" onclick="parse(this)">Submit</button>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script src="//oss.maxcdn.com/semantic-ui/2.1.3/semantic.min.js"></script>
        <script>
            $(document).ready(function ()
            {

                $('.ui.accordion').accordion();
                $('.ui.dropdown').dropdown();
                $('.ui.checkbox').checkbox();
                $.fn.api.settings.api = {
                    'goto user': '/user/{id}',
                    'follow user': '/user/{id}/follow',
                    'unfollow user': '/user/{id}/unfollow',
                    'follow anime': '/anime/{id}/follow',
                    'unfollow anime': '/anime/{id}/unfollow'
                };

            });
            /*var config = {
                routes: [
                    { show:  }
                ]
            }*/
        </script>
    </body>
</html>

