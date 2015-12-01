@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui segment" style="background:#1A1A1A">
            <h3 style="color:white">Change Password</h3>
            {!! Form::model( $user, [ 'method'=>'PATCH', 'route'=>[ 'user.updatePassword', $user->id ], 'class'=>'ui form' ] ) !!}
            <div class="field">
                {!! Form::label( 'password', 'Current Password', [ 'style'=>'color:white' ] ) !!}
                {!! Form::password( 'password' ) !!}
            </div>
            <div class="field">
                {!! Form::label( 'password', 'New Password', [ 'style'=>'color:white' ] ) !!}
                {!! Form::password( 'new_password' ) !!}
            </div>
            <div class="field">
                {!! Form::label( 'password', 'Verify New Password', [ 'style'=>'color:white' ] ) !!}
                {!! Form::password( 'verify_password' ) !!}
            </div>
            <div class="field">
                {!! Form::submit( 'Save', [ 'class'=>'ui button' ] ) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
