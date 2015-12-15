@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui stackable grid">
            <div class="row">
                <div class="ui segment" style="background:#1A1A1A">
                    <h1 style="color:white">{{ $anime->name  }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="six wide column">
                    <div class="ui segment" style="background:#1A1A1A">
                        <img class="ui medium image" src="{{ asset( $anime->profile_url ) }}">
                        <br>
                        @for( $i = 1; $i <= $anime->numEpisodes; $i++ )
                            <a href="{{route('anime.watch', [$anime->id])}}" style="font-size: 20px">
                                {{ $anime->name }} Episode {{ $i }}
                            </a>
                            <br>
                            <br>
                        @endfor
                    </div>
                </div>
                <div class="ten wide column">
                    <div class="ui segment" style="background:#1A1A1A">
                        <h1 style="color:white">Genres: &nbsp
                            @foreach( $data as $name )
                                {{ $name[ 'name' ] }} &nbsp
                            @endforeach
                        </h1>

                        <h1 style="color:white">Status: &nbsp {{ $anime->status }}</h1>

                        <h1 style="color:white">Number of Seasons: &nbsp {{ $anime->numSeasons }}</h1>

                        <h1 style="color:white">Number of Episodes: &nbsp {{ $anime->numEpisodes }}</h1>

                        <h1 style="color:white">About</h1>

                        <h3 style="color:white">{{ $anime->description }}</h3>

                        <h2 style="color:white">Number of People Following this Anime: &nbsp <span
                                    id="num-followers"> {{ $anime->user_followers->count() }}</span></h2>
                        @if( !Auth::guest() )
                            <script>
                                function show(button) {

                                    if (!$(button).hasClass("active")) {

                                        $('.toggle.button').api({

                                            onSuccess: function (response) {

                                                var num_followers = response.followers;
                                                $('span#num-followers').text(num_followers);
                                                $(this).data("action", "unfollow anime");

                                            }

                                        });

                                    }
                                    else {

                                        $('.toggle.button').api({

                                            onSuccess: function (response) {

                                                var num_followers = response.followers;
                                                $('span#num-followers').text(num_followers);
                                                $(this).data("action", "follow anime");

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
                            @if( $anime->user_followers->contains( Auth::user() ) )
                                <div class="ui toggle button active" onclick="show(this)" data-action="unfollow anime"
                                     data-id="{{ $anime->id }}">
                                    Unfollow
                                </div>
                            @else
                                <div class="ui toggle button" onclick="show(this)" data-action="follow anime"
                                     data-id="{{ $anime->id }}">
                                    Follow
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection