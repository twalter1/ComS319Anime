@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui segment" style="background:#1A1A1A">
            <h3 style="color:white">Sign Up</h3>

            <form class="ui form"  role="form" method="POST" action="{{ url('/auth/register') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label style="color:white">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Email" >
                </div>
                <br>
                <div class="form-group">
                    <label style="color:white">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" >
                </div>
                <br>
                <div class="two fields">
                    <div class="field">
                        <label style="color:white">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="field">
                        <label style="color:white">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>
                <br>
                <div>
                    <button type="submit" class="ui button">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
