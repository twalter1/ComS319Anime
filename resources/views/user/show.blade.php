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
                        <img class="ui small image" src="{{ asset('/images/image.png') }}">

                        <h1 style="color:white">Profile Pic coming soon</h1>

                        <h2 style="color:white">Email: {{ $user->email }}</h2>

                        <h3 style="color:white">Number of Followers: <span id="num-followers"> {{ $user->followers->count() }}</span></h3>
                    </div>
                </div>
                <div class="ten wide column">
                    <div class="ui segment" style="background:#1A1A1A">
                        <h1 style="color:white">About</h1>
                        <!--<textarea>{{ $user->description }}</textarea>-->
                        <h3 style="color:white">{{ $user->description }}</h3>
                    </div>
                    @if( !Auth::guest() && ( Auth::id() != $user->id ) )
                        <script>

                            function show(button)
                            {

                                if ( !$(button).hasClass( "active" ) )
                                {

                                    $( '.toggle.button' ).api({

                                            onSuccess: function (response)
                                            {

                                                var num_followers = response.followers;
                                                $( 'span#num-followers' ).text( num_followers );

                                            }

                                    });

                                }
                                else
                                {

                                    $( '.toggle.button' ).api({

                                        onSuccess: function (response)
                                        {

                                            var num_followers = response.followers;
                                            $( 'span#num-followers' ).text( num_followers );

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
                        @if($user->followers->contains(Auth::user()))
                            <div class="ui toggle button active" onclick="show(this)" data-action="unfollow user"
                                 data-id="{{ $user->id }}">
                                Unfollow
                            </div>
                        @else
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