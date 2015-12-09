@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui stackable grid">
            <div class="row">
                <div class="ui segment" style="background:#1A1A1A">
                    <h1 style="color:white">{{ $anime->name }} Episode</h1>
                </div>
            </div>
            <div class="row">
                <div class="ten wide column">
                    <div class="ui segment" style="background:#1A1A1A">
                        <h1 style="color:white">This would be where the Video plays</h1>
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui segment" style="background:#1A1A1A">
                        @for( $i = 1; $i <= $anime->numEpisodes; $i++ )
                            <a href="{{route('anime.watch', [$anime->id, $i])}}" style="font-size: 20px">
                                {{ $anime->name }} Episode {{ $i }}
                            </a>
                            <br>
                            <br>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection