@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui segment" style="background:#1A1A1A">
            <h3 style="color:white">Users</h3>
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th># of Followers</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <a href="{{route('user.show', [$user->id])}}">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->followers->count()}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
