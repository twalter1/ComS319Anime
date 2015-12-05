@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui segment" style="background:#1A1A1A">
            <h1 style="color:white">Welcome to our website</h1>
            <h2 style="color:white">
                If you already know what you are looking for you can search our site here.
                Otherwise feel free to navigate through our site with the menu above.
            </h2>
            <p style="color:#1A1A1A">filler</p>
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search" >
            </div>
        </div>
    </div>
@endsection
