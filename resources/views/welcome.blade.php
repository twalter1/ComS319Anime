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

    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    <style>
        table, th , td {
            border: 1px solid grey;
            border-collapse: collapse;
            padding: 5px;
        }
        table tr:nth-child(odd) {
            background-color: #f1f1f1;
        }
        table tr:nth-child(even) {
            background-color: #ffffff;
        }

    </style>

    <body>

    <div ng-app="myApp" ng-controller="namesCtrl">
        <p>Filtering input:</p>

        <p><input type="text" ng-model="test"></p>




        <table ng-show="test.length > 0">
            <tr ng-repeat="x in names  | filter:{'name':test} |  orderBy:'name'">

                <td>{{ $index + 1 }}</td>
                <td>{{ x.name }}</td>
                <td>{{ x.genres.toUpperCase() }}</td>
                <td>{{x.status}}</td>
            </tr>
        </table>


    </div>


    <script>


        var data = [];
        @foreach ($animes as $anime)
            //alert( '{{ $anime->name }}' );
        var jsonData = {};
        jsonData[ "id" ] = '{{ $anime->id }}';
        jsonData[ "name" ] = '{{ $anime->name }}';
        jsonData[ "numEpsisodes" ] = '{{ $anime->numEpisodes }}';
        //alert( '{{ $anime->genre }}' );
        //alert( JSON.stringify( '{{ $anime->genre }}'))
        //alert( eval( "(" + '{{ $anime->genre }}'.replace( /&quot;/g, '"' ) + ")" ) );
        jsonData[ "genres" ] = eval( "(" + ( '{{ $anime->genre }}'.replace( /&quot;/g, '"' ) ) + ")" );
        jsonData[ "numSeasons" ] = '{{ $anime->numSeasons }}';
        jsonData[ "status" ] = '{{ $anime->status }}';
        data.push( jsonData );
        //alert( JSON.stringify( newJsonData ) );
                @endforeach

            for(var i=0;i<data.length;i++){
            data[i].genres=stringIt(data[i].genres);
        }

        var app = angular.module('myApp', []);

        angular.module('myApp', [])

                .controller('namesCtrl', function($scope) {
                    $scope.names = data;
                    $scope.test="";


                });



        function stringIt(jso){
            var string="";
            for(var i=0;i<jso.length;i++){
                if(i!=0){
                    string+="   ";
                }
                string+=jso[i].name;
            }
            return string;
        }
    </script>

    </body>
@endsection
