@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui segment" style="background:#1A1A1A">
            <h1 style="color:white">Welcome to our website</h1>
            <h2 style="color:white">
                If you already know what you are looking for you can search our site here.
                Otherwise feel free to navigate through our site with the menu above.
            </h2>

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
                <div class="form-group">
                    <label style="color:white">Search Anime</label>
                    <input type="text" class="form-control" name="search" placeholder="Search" ng-model="test" >
                </div>
                <!--<p style="color:snow">Search Anime:</p>

                <p><input type="text" ng-model="test"></p>-->




                <table ng-show="test.length > 0">
                    <tr ng-repeat="x in names  | filter:{'name':test} |  orderBy:'name'">

                        <td><% $index + 1 %></td>
                        <td> <a href="anime/<% x.id %>"><% x.name | front:test %><text style="background-color: yellow"><% x.name | mid:test %></text><% x.name | end:test %></a></td>
                        <td><% x.genres.toUpperCase() %></td>
                        <td><%x.status%></td>
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

                angular.module('myApp', [], function($interpolateProvider) {
                            $interpolateProvider.startSymbol('<%');
                            $interpolateProvider.endSymbol('%>');
                        })
                        .filter('front',function(){
                            return function(input, txt) {
                                var str = input.toUpperCase();
                                txt=txt.toUpperCase();
                                var index=str.indexOf(txt);
                                return input.slice(0,index);
                            }})
                        .filter('mid',function(){
                            return function(input, txt) {
                                var str = input.toUpperCase();
                                txt=txt.toUpperCase();
                                var index=str.indexOf(txt);
                                var l=txt.length;
                                return input.slice(index,index+l);
                            }})
                        .filter('end',function(){
                            return function(input, txt) {
                                var str = input.toUpperCase();
                                txt=txt.toUpperCase();
                                var index=str.indexOf(txt);
                                var l=txt.length;
                                return input.slice(index+l);
                            }})
                        .controller('namesCtrl', function($scope) {
                            $scope.names = data;
                            $scope.test="";
                            $scope.index = 0;


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
        </div>
    </div>
@endsection
