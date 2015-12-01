@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui segment" style="background:#1A1A1A">
            <h3 style="color:white">Edit Profile</h3>
            {!! Form::model( $user, [ 'method'=>'PATCH', 'route'=>['user.update', $user->id], 'class'=>'ui form', 'files'=>true ] ) !!}
            <div class="field">
                {!! Form::label( 'name', 'Name:', [ 'style'=>'color:white' ] ) !!}
                {!! Form::text( 'name', null ) !!}
            </div>
            <div class="field">
                {!! Form::label( 'email', 'Email:', [ 'style'=>'color:white' ] ) !!}
                {!! Form::email( 'email', null ) !!}
            </div>
            <div class="field">
                {!! Form::label( 'description', 'About:', [ 'style'=>'color:white' ] ) !!}
                {!! Form::textarea( 'description', null ) !!}
            </div>
            <div class="field">
                {!! Form::submit( 'Save', [ 'class'=>'ui button' ] ) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection