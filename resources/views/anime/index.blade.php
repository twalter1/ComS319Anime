@extends('app')

@section('content')
    <h1 style="color:white">Animes</h1>
    <style>
        .node circle {
            cursor: pointer;
            fill: #fff;
            stroke: steelblue;
            stroke-width: 1.5px;
        }

        .node text {
            font-size: 20px;
            fill: snow;
        }

        path.link {
            fill: none;
            stroke: #ccc;
            stroke-width: 1.5px;
        }
    </style>
    <body id="body">
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


                var letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"

        var LETTERS = [];

        for (var i = 0; i < 27; i++) {
            var arr = [];
            LETTERS.push(arr);
        }

        var alphabet = {
            "name": "Animes", "children": []
        };

        //var colors=["#ff0000", "#ff8000", "#ffff00", "#80ff00", "#00ff00", "#00ff80", "#00ffff", "#007fff", "#0000ff", "#7f00ff", "#ff00ff", "#ff0080"];

        var sizeData = Object.keys(data).length;

        for (var i = 0; i < data.length; i++) {
            data[i].num = data[i].id;
            data[i].id = 0;
            var show = data[i].name.toLowerCase();
            if (show.indexOf("the ") == 0) {
                show.slice(4);
            }
            var ch = show.charAt(0).toUpperCase();
            var indx = letters.indexOf(ch) + 1;
            insertSort(LETTERS[indx], data[i]);


        }

        if (LETTERS[0].length > 0) {

            alphabet.children.push(
                    {"name": "0-9", "children": LETTERS[0]}
            )
        } else {
            alphabet.children.push(
                    {"name": "0-9", "size": 1200}
            )
        }
        for (var i = 1; i < LETTERS.length; i++) {
            if (LETTERS[i].length > 0) {
                alphabet.children.push(
                        {"name": letters[i - 1], "children": LETTERS[i]}
                )

            } else {
                alphabet.children.push(
                        {"name": letters[i - 1], "size": 1200}
                )
            }
        }
        function insertSort(array, obj) {

            for (var i = 0; i < array.length; i++) {
                if (obj.name.localeCompare(array[i].name) == -1) {
                    array.splice(i, 0, obj);
                    return;
                }
            }
            array.push(obj);
        }


        var m = [20, 120, 20, 120],
                w = 1280 - m[1] - m[3],
                h = 800 - m[0] - m[2],
                i = 0,
                root;

        var tree = d3.layout.tree()
                .size([h, w]);

        var diagonal = d3.svg.diagonal()
                .projection(function (d) {
                    return [d.y, d.x];
                });

        var vis = d3.select("#body").append("svg:svg")
                .attr("width", w + m[1] + m[3])
                .attr("height", h + m[0] + m[2])
                .append("svg:g")
                .attr("transform", "translate(" + m[3] + "," + m[0] + ")");

        d3.json(alphabet, function (json) {
            root = alphabet;
            root.x0 = h / 2;
            root.y0 = 0;

            function toggleAll(d) {
                if (d.children) {
                    d.children.forEach(toggleAll);
                    toggle(d);
                }
            }

            // Initialize the display to show a few nodes.
            root.children.forEach(toggleAll);
            //toggle(root.children[1]);
            //toggle(root.children[1].children[2]);
            //toggle(root.children[9]);
            //toggle(root.children[9].children[0]);

            update(root);
        });

        function update(source) {
            var duration = d3.event && d3.event.altKey ? 5000 : 500;

            // Compute the new tree layout.
            var nodes = tree.nodes(root).reverse();

            // Normalize for fixed-depth.
            nodes.forEach(function (d) {
                d.y = d.depth * 180;
            });

            // Update the nodes…
            var node = vis.selectAll("g.node")
                    .data(nodes, function (d) {
                        return d.id || (d.id = ++i);
                    });

            // Enter any new nodes at the parent's previous position.
            var nodeEnter = node.enter().append("svg:g")
                    .attr("class", "node")
                    .attr("transform", function (d) {
                        return "translate(" + source.y0 + "," + source.x0 + ")";
                    })
                    .on("click", function (d) {
                        toggle(d);
                        update(d);
                    });

            nodeEnter.append("svg:circle")
                    .attr("r", 1e-6)
                    .style("fill", function (d) {
                        return d._children ? "lightsteelblue" : "#fff";
                    });

            nodeEnter.append("svg:text")
                    .attr("x", function (d) {
                        return d.children || d._children ? -10 : 10;
                    })
                    .attr("dy", ".35em")
                    .attr("text-anchor", function (d) {
                        return d.children || d._children ? "end" : "start";
                    })
                    .attr('href', function (d) {
                        if (d.num != null) {
                            return 'anime/' + d.num;
                        }
                        return "";
                    })
                    .text(function (d) {
                        return d.name;
                    })
                    .style("fill-opacity", 1e-6)
                    .on("click", function (d) {
                        toggle(d);
                        update(d);
                    });

            // Transition nodes to their new position.
            var nodeUpdate = node.transition()
                    .duration(duration)
                    .attr("transform", function (d) {
                        return "translate(" + d.y + "," + d.x + ")";
                    });

            nodeUpdate.select("circle")
                    .attr("r", 4.5)
                    .style("fill", function (d) {
                        return d._children ? "lightsteelblue" : "#fff";
                    });

            nodeUpdate.select("text")
                    .style("fill-opacity", 1);

            // Transition exiting nodes to the parent's new position.
            var nodeExit = node.exit().transition()
                    .duration(duration)
                    .attr("transform", function (d) {
                        return "translate(" + source.y + "," + source.x + ")";
                    })
                    .remove();

            nodeExit.select("circle")
                    .attr("r", 1e-6);

            nodeExit.select("text")
                    .style("fill-opacity", 1e-6);

            // Update the links…
            var link = vis.selectAll("path.link")
                    .data(tree.links(nodes), function (d) {
                        return d.target.id;
                    });

            // Enter any new links at the parent's previous position.
            link.enter().insert("svg:path", "g")
                    .attr("class", "link")
                    .attr("d", function (d) {
                        var o = {x: source.x0, y: source.y0};
                        return diagonal({source: o, target: o});
                    })
                    .transition()
                    .duration(duration)
                    .attr("d", diagonal);

            // Transition links to their new position.
            link.transition()
                    .duration(duration)
                    .attr("d", diagonal);

            // Transition exiting nodes to the parent's new position.
            link.exit().transition()
                    .duration(duration)
                    .attr("d", function (d) {
                        var o = {x: source.x, y: source.y};
                        return diagonal({source: o, target: o});
                    })
                    .remove();

            // Stash the old positions for transition.
            nodes.forEach(function (d) {
                d.x0 = d.x;
                d.y0 = d.y;
            });
        }

        // Toggle children.
        function toggle(d) {
            if (d.num != null) {
                window.location.href = "anime/" + d.num;
            }

            if (d.children) {
                d._children = d.children;
                d.children = null;
            } else {
                d.children = d._children;
                d._children = null;
            }
        }
    </script>
    </body>
@endsection
