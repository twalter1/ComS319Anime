@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui stackable grid">
            <div class="row">
                <div class="ui segment" style="background:#1A1A1A">
                    <h1 style="color:white">{{ $user->name }}'s Profile</h1>
                </div>
            </div>
            <div class="row">
                <div class="six wide column">
                    <div class="ui segment" style="background:#1A1A1A">
                        <!-- this image was taken from http://semantic-ui.com/elements/image.html -->
                        @if( $user->avatar_url == null )
                            <img class="ui small image" src="{{ asset( 'images/image.png' ) }}">
                        @else
                            <img class="ui small image" src="{{ asset( $user->avatar_url ) }}">
                        @endif

                        <h2 style="color:white">Email: {{ $user->email }}</h2>

                        <h3 style="color:white">Number of Followers: &nbsp<span
                                    id="num-followers"> {{ $user->followers->count() }}</span></h3>
                    </div>
                </div>
                <div class="ten wide column">
                    <div class="ui segment" style="background:#1A1A1A">
                        <h1 style="color:white">About</h1>
                        <!--<textarea>{{ $user->description }}</textarea>-->
                        <h3 style="color:white">{{ $user->description }}</h3>
                        @if( Auth::id() == $user->id )
                            <h1 style="color:white">People You are Following</h1>
                            @foreach( $user->following as $followingUser )
                                <a href="{{route('user.show', [$followingUser->id])}}">
                                    {{ $followingUser->name }}
                                </a>
                                <br>
                            @endforeach
                            <h1 style="color:white">Animes that You are Following</h1>
                            @foreach( $user->animes_following as $followingYourAnime )
                                <a href="{{route('anime.show', [$followingYourAnime->id])}}">
                                    {{ $followingYourAnime->name }}
                                </a>
                                <br>
                            @endforeach
                        @endif
                    </div>
                    @if( !Auth::guest() && ( Auth::id() != $user->id ) )
                        <script>
                            function show(button) {

                                if (!$(button).hasClass("active")) {

                                    $('.toggle.button').api({

                                        onSuccess: function (response) {

                                            var num_followers = response.followers;
                                            $('span#num-followers').text(num_followers);
                                            console.log(response.animes_following);
                                            animes = '';

                                            $.each(response.animes_following,
                                                    function (key, value) {
                                                        animes += '<a href="anime/' + value.id + '">'
                                                                + value.name +
                                                                '</a><br>';
                                                    }
                                            );
                                            animes += '<br>';

                                            $('div#animes-following').html(animes);
                                            $('#anime-header').removeClass("hidden");

                                            $(this).data("action", "unfollow user");

                                        }

                                    });

                                }
                                else {

                                    $('.toggle.button').api({

                                        onSuccess: function (response) {

                                            var num_followers = response.followers;
                                            $('span#num-followers').text(num_followers);
                                            $(this).data("action", "follow user");

                                            $('div#animes-following').html('');
                                            $('#anime-header').addClass("hidden");
                                        }

                                    });

                                }

                            }
                            $(document).ready(function () {

                                var $toggle = $('.ui.toggle.button');
                                $toggle.state({

                                    text: {

                                        inactive: 'Follow',
                                        active: 'Unfollow'

                                    }

                                });

                            });
                        </script>
                        @if( $user->followers->contains( Auth::user() ) )
                            <h1 style="color:white" id="anime-header">Animes that {{ $user->name }} is Following</h1>
                            <div id="animes-following">
                                @foreach( $user->animes_following as $followingAnime )
                                    <a href="{{route('anime.show', [$followingAnime->id])}}">
                                        {{ $followingAnime->name }}
                                    </a>
                                    <br>
                                @endforeach
                                <br>
                            </div>

                            <div class="ui toggle button active" onclick="show(this)" data-action="unfollow user"
                                 data-id="{{ $user->id }}">
                                Unfollow
                            </div>
                        @else
                            <h1 style="color:white" class="hidden" id="anime-header">Animes that {{ $user->name }} is
                                Following</h1>
                            <div id="animes-following"></div>
                            <div class="ui toggle button" onclick="show(this)" data-action="follow user"
                                 data-id="{{ $user->id }}">
                                Follow
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection