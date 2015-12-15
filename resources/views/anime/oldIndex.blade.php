@extends('app')

@section('content')
    <div class="ui container" style="background:#1A1A1A">
        <div class="ui segment" style="background:#1A1A1A">
            <!--<form class="ui fluid form">
                 <div class="field" id="title">
                     <input type="text" placeholder="Search by Name">
                 </div>
                 <div class="field">
                     <label style="color:white">Status</label>
                     <div class="ui selection dropdown" id="statusPrefer">
                         <input type="hidden" name="Status">
                         <i class="dropdown icon"></i>
                         <div class="default text">Both</div>
                         <div class="menu">
                             <div class="item" data-value="0">Both</div>
                             <div class="item" data-value="1">Inprogress</div>
                             <div class="item" data-value="2">Completed</div>
                         </div>
                     </div>
                 </div>
                 <div class="field">
                     <div class="ui checkbox" id="pick">
                         <input type="checkbox" name="relation">
                         <label style="color:white">Search by Relation</label>
                     </div>
                 </div>

                   <div class="field">
                       <div class="ui fluid selection dropdown" id="similarnum">
                           <input type="hidden" name="similar">
                           <i class="dropdown icon"></i>
                           <div class="menu">
                               <div class="item" data-value="0">1</div>
                               <div class="item" data-value="1">2</div>
                               <div class="item" data-value="2">3</div>
                               <div class="item" data-value="3">4</div>
                               <div class="item" data-value="4">5</div>
                               <div class="item" data-value="5">6</div>
                               <div class="item" data-value="6">7</div>
                               <div class="item" data-value="7">8</div>
                               <div class="item" data-value="7">9</div>
                               <div class="item" data-value="9">10</div>
                           </div>
                       </div>
                   </div>

                 <div class="field">
                     <label style="color:white">Search by Genre</label>
                     <div class="ui fluid selection dropdown" id="genrePrefer">
                         <input type="hidden" name="Genre">
                         <i class="dropdown icon"></i>
                         <div class="item" data-value="all">All</div>
                         <!--<div class="menu">
                             <div class="item" data-value="0">All</div>
                             <div class="item" data-value="1">Horror</div>
                             <div class="item" data-value="2">Action</div>
                             <div class="item" data-value="3">Romance</div>
                             <div class="item" data-value="4">Tragedy</div>
                             <div class="item" data-value="5">Mecha</div>
                             <div class="item" data-value="6">Comedy</div>
                         </div>
                     </div>
                 </div>
             </form>-->
            <!--The selection module used to format and search through the data graph-->

            <div id="box">
                <p>
                    <!--text box to search by name,  matching results will gain a bold outline-->
                    Search by Name:
                    <input id="title" type="text" style="color:Black">
                    <!--option will have graph show only shows which are completed or not-->
                    Status
                    <select class="choice" id=statusPrefer style="color:Black">
                        <option value="none">Both</option>
                        <option value="done">Completed</option>
                        <option value="notdone">In Progress</option>
                    </select>
                </p>

                <p id=left>
                    <!--toggles graph between genre web (sorted()) and interconnected (basic()) layout-->
                    Search by Relation:
                    <input id="pick" class="choice" type="checkbox" name="type">

                <p class="selector" id="default">
                    <!--genre selection for sorted()-->
                    Genres:
                    <select class="choice" id=genrePrefer style="color:Black">
                        <option value="all">All</option>
                    </select>
                </p>
                <p class="selector" id="other">
                    <!--number of similar genres required for basic()-->
                    number of similar genres
                    <input class="choice" id="similarnum" type="number" name="quantity" min="1" max="50" value="1"
                           style="color:Black">
                </p>

                <p id="label">
                </p>
            </div>
            <script>

                var width = 800;
                var height = 650;

                var data = [];
                @foreach ($animes as $anime)
                //alert( '{{ $anime->name }}' );
                var jsonData = {};
                jsonData["id"] = '{{ $anime->id }}';
                jsonData["name"] = '{{ $anime->name }}';
                jsonData["numEpsisodes"] = '{{ $anime->numEpisodes }}';
                //alert( '{{ $anime->genre }}' );
                //alert( JSON.stringify( '{{ $anime->genre }}'))
                //alert( eval( "(" + '{{ $anime->genre }}'.replace( /&quot;/g, '"' ) + ")" ) );
                jsonData["genres"] = eval("(" + ( '{{ $anime->genre }}'.replace(/&quot;/g, '"') ) + ")");
                jsonData["numSeasons"] = '{{ $anime->numSeasons }}';
                jsonData["status"] = '{{ $anime->status }}';
                data.push(jsonData);
                //alert( JSON.stringify( newJsonData ) );
                @endforeach


                //var data = JSON.stringify( newJsonData );
                //alert( data );
                //alert( data[0].genres );
                //alert( data[0].genres[1].name );

                var graph = {"nodes": [], "links": []};

                // clears json in between states and formats

                function clear() {

                    graph = {"nodes": [], "links": []};
                    d3.select("svg").remove();

                }
                var colors = ["#ff0000", "#ff8000", "#ffff00", "#80ff00", "#00ff00", "#00ff80", "#00ffff", "#007fff", "#0000ff", "#7f00ff", "#ff00ff", "#ff0080"];

                var sizeData = Object.keys(data).length;


                //places the nodes in the graph by giving those without x or y coordinates
                //positions based on a polar grid
                //this prevents glitching positions of the graph

                function place() {

                    var size = Object.keys(graph.nodes).length;
                    var theta = 2 * Math.PI / size;
                    for (var i = 0; i < size; i++) {

                        if (graph.nodes[i].x == null) {

                            phi = i * theta;
                            x0 = width / 2 - Math.cos(phi) * width / 4;
                            y0 = height / 2 - Math.sin(phi) * width / 4;
                            graph.nodes[i]["x"] = x0;
                            graph.nodes[i]["y"] = y0;

                        }

                    }

                }


                var maxSeasons = 0;
                for (var i = 0; i < sizeData; i++) {

                    if (data[i].numSeasons > maxSeasons) {

                        maxSeasons = data[i].numSeasons;

                    }

                }


                //formats the graph for linkage via similar genres
                //can change the required number of similar genres from the number dialog box
                //
                //First it calls selectData() and place()
                //then it runs through the data json of graph
                //for each two nodes with the required similar number of genres,
                //it makes a link between them and ands it to the links json of graph.

                function basic() {

                    selectData();
                    place();
                    var size = Object.keys(graph.nodes).length;
                    for (var i = 0; ( i + 1 ) < size; i++) {

                        var j = i + 1;
                        g1 = Object.keys(graph.nodes[i].genres).length;

                        for (j; j < size; j++) {

                            g2 = Object.keys(graph.nodes[j].genres).length;
                            var er = 0
                            for (var k = 0; k < g1; k++) {

                                for (var l = 0; l < g2; l++) {

                                    if (graph.nodes[i].genres[k].name == graph.nodes[j].genres[l].name) {

                                        er++;
                                        if (er > $("#similarnum").val() - 1) {

                                            var newlink = {"source": i, "target": j};
                                            graph.links.push(newlink);

                                        }

                                    }

                                }

                            }

                        }

                    }
                    plotNodes();

                }


                // Now we create a force layout object and define its properties.
                // Those include the dimensions of the visualization and the arrays
                // of nodes and links.
                function plotNodes() {

                    var svg = d3.select('body').append('svg').attr('width', width).attr('height', height);

                    // Extract the nodes and links from the data.
                    var nodes = graph.nodes;
                    var links = graph.links;

                    var force = d3.layout.force().size([width, height]).charge(-500).gravity(.25).linkDistance(maxSeasons * 6);


                    var link = svg.selectAll('.link').data(links).enter().append('line').attr('class', 'link');

                    //creation of the node objects

                    var node = svg.selectAll('.node')
                            .data(nodes)
                            .enter().append('circle')
                            .attr('class', 'node')
                            .attr('name', function (d) {
                                return d.name;
                            })
                            .attr('r', function (d) {
                                return d.numSeasons * 5;
                            })
                            .style("fill", function (d) {
                                return colors[d.id % 12];
                            })
                            .call(force.drag);

                    force.nodes(graph.nodes).links(graph.links).start();
                    var size = Object.keys(graph.nodes).length;
                    for (var i = 10 * size * size; i > 0; --i) force.tick();
                    force.stop();

                    //these are the position properties for each node and link
                    //they will change with the simulation

                    node.attr('cx', function (d) {
                        return d.x;
                    }).attr('cy', function (d) {
                        return d.y;
                    });


                    link.attr('x1', function (d) {
                        return d.source.x;
                    })
                            .attr('y1', function (d) {
                                return d.source.y;
                            })
                            .attr('x2', function (d) {
                                return d.target.x;
                            })
                            .attr('y2', function (d) {
                                return d.target.y;
                            });

                    //reassigns jquery listeners to the svg on each refresh
                    //these include mouselisteners to highlight and return the nodes name
                    //as well as a dialog box listener for the search function


                    $("#svg").ready(function () {

                        $(".node").on('mouseover', function () {

                            this.setAttribute("stroke-width", "3px");
                            tip = document.createElement("p");
                            tip.innerHTML = this.getAttribute("name");
                            document.getElementById("label").appendChild(tip);

                        });

                        $(".node").on('mouseout', function () {

                            this.setAttribute("stroke-width", "1px");
                            document.getElementById("label").removeChild(tip);

                        });

                        $("#title").keyup(function () {

                            $(".node").each(function () {

                                var g = this;
                                str = document.getElementById("title").value;
                                if (g.getAttribute("name").toLowerCase().indexOf(str.toLowerCase()) > -1 && str != "" && g.__data__.genres != "none") {

                                    this.setAttribute("stroke-width", "3px");

                                }
                                else {

                                    this.setAttribute("stroke-width", "1px");

                                }

                            })

                        });

                    });

                }


                //button listens for the control panel

                $(document).ready(function () {

                    sorted();
                    $("#other").hide();
                    $("#btn0").click(function () {

                        basic();

                    });

                    $("#btn1").click(function () {

                        clear();

                    });

                    $("#pick").click(function () {

                        $(".selector").toggle();
                        clear();
                        if (document.getElementById("pick").checked) {

                            basic();

                        }
                        else {

                            sorted();

                        }

                    });

                    $(".choice").change(function () {

                        clear();
                        if (document.getElementById("pick").checked) {

                            basic();

                        }
                        else {

                            sorted();

                        }

                    });

                });


                // gets the genres present in the given data json

                var genreArr = [];
                //alert( data[1].genres );
                for (var i = 0; i < sizeData; i++) {

                    num = Object.keys(data[i].genres).length;
                    for (var j = 0; j < num; j++) {

                        if (jQuery.inArray(data[i].genres[j].name, genreArr) == -1) {

                            genreArr.push(data[i].genres[j].name);

                        }

                    }

                }

                // creates options for each genre for the selection box

                for (var i = 0; i < genreArr.length; i++) {

                    gen = document.createElement("option");
                    gen.setAttribute("value", genreArr[i]);
                    gen.innerHTML = genreArr[i].toUpperCase();
                    document.getElementById("genrePrefer").appendChild(gen);

                }


                //formats graph for the web layout based on genres
                //
                //first it runs selectData() and place() to get and format
                //the applicable shows
                //then it adds the anchor points for each genre
                //then it runs through the selected data and creates links
                //between each node and its genres

                function sorted() {

                    selectData();
                    place();
                    var size = Object.keys(graph.nodes).length;
                    addGenres(size);
                    g2 = genreArr.length;

                    for (var i = 0; i < size; i++) {

                        g1 = Object.keys(graph.nodes[i].genres).length;


                        for (var k = 0; k < g1; k++) {

                            for (var l = 0; l < g2; l++) {

                                if (graph.nodes[i].genres[k].name.toUpperCase() == graph.nodes[size + l].name) {

                                    var newlink = {"source": i, "target": size + l};
                                    graph.links.push(newlink);

                                }

                            }

                        }

                    }
                    plotNodes();

                }

                //creates large anchored nodes for each genre for the sorted layout

                function addGenres(size) {

                    var theta = 2 * Math.PI / genreArr.length;
                    for (var i = 0; i < genreArr.length; i++) {

                        phi = -i * theta;
                        var x0 = width / 2 - Math.sin(phi) * width / 3;
                        var y0 = height / 2 - Math.cos(phi) * width / 3;
                        var newnode =
                        {

                            "id": size + i,
                            "name": genreArr[i].toUpperCase(),
                            "numSeasons": maxSeasons * 1.5,
                            "x": x0,
                            "y": y0,
                            "genres": "none",
                            "fixed": true

                        };
                        graph.nodes.push(newnode);

                    }

                }

                //runs through the data and selects the shows which match the
                //selection from the user
                //
                //these include genre and show completion status

                function selectData() {

                    var size = Object.keys(data).length;

                    for (var i = 0; i < size; i++) {

                        var stat = true;
                        if (document.getElementById("statusPrefer").value == "done" && data[i].status == "ongoing") {

                            stat = false;

                        }
                        else if (document.getElementById("statusPrefer").value == "notdone" && data[i].status == "completed") {

                            stat = false;

                        }
                        if (stat) {

                            if (document.getElementById("pick").checked || document.getElementById("genrePrefer").value == "all") {

                                graph.nodes.push(data[i]);

                            }
                            else {

                                ge = Object.keys(data[i].genres).length;
                                for (var k = 0; k < ge; k++) {

                                    if (document.getElementById("genrePrefer").value == data[i].genres[k].name)
                                        graph.nodes.push(data[i]);

                                }

                            }

                        }

                    }

                }

            </script>
        </div>
    </div>
@endsection
