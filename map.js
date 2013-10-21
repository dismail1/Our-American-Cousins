var width = 650,
    height = 500,
    centered;

var projection = d3.geo.albersUsa()
    .scale(600)
    .translate([width / 2, height / 2]);

var path = d3.geo.path()
    .projection(projection);

var svg = d3.select("body").append("svg")

    .attr("width", width)
    .attr("height", height);

svg.append("rect")
    .attr("class", "background")
    .attr("width", width)
    .attr("height", height)   
    .on("click", clicked);

var g = svg.append("g");


d3.json("us-named.json", function(error, us) {
  g.append("g")
      .attr("id", "states")
      .selectAll("path")
      .data(topojson.feature(us, us.objects.states).features)
      .enter().append("path")
      .attr("d", path)
      .attr("title", function(d,i) { return d.properties.name; })
      .call(d3.helper.tooltip()
                .attr({class: function(d,i) {return d +' '+  i + ' A';; }})
                .style({color: "#aaaaaa"})
                .text(function(d,i){return d.properties.name ; }))
      //.on("mouseover", function(){d3.select(this).style("fill", "#0000FF");})
     
     // .on("mouseout", function(){d3.select(this).style("fill", "#000066");})
      .on("click", clicked);


  g.append("path")
      .datum(topojson.mesh(us, us.objects.states, function(a, b) { return a !== b; }))
      .attr("id", "state-borders")
      .attr("d", path);
      
g.selectAll(".subunit-label")
        .data(topojson.feature(us, us.objects.states).features)
        .enter().append("text")
        .attr("class", function(d) { return "subunit-label " + d.id; })
        .attr("transform", function(d) { return "translate(" + path.centroid(d) + ")"; })
        .attr("dy", ".35em")
        .text(function(d) { return d.properties.code; });
        

      
});


function clicked(d) {
  var x, y, k;

  if (d && centered !== d) {
    
    var centroid = path.centroid(d);
    x = centroid[0];
    y = centroid[1];
    k = 4;
    centered = d;
    g.selectAll("path")
  
     //.on("mouseout", function(){d3.select(this).style("fill", "#0000FF");});
      .classed("active", centered && function(d) { return d === centered; });
      top.frames['frame3'].location.href = "StateInfo.php?name="+ d.properties.name;
    

  } else {
    x = width / 2;
    y = height / 2;
    k = 1;
    centered = null;
    g.selectAll("path")
  
    //.on("mouseout", function(){d3.select(this).style("fill", "#000066");})
  
      .classed("active", centered && function(d) { return d === centered; });
      top.frames['frame3'].location.href = "StateInfo.php?name=USA";
    
  }

  

  g.transition()
      .duration(700)
      .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")scale(" + k + ")translate(" + -x + "," + -y + ")")
      .style("stroke-width", 1.5 / k + "px")
    
}


