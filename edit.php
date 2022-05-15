<!DOCTYPE HTML>
<html>
<head>
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
	title:{
    	text: "Chart Title",       
	},      
	data: [
	{
        type: "column",
        dataPoints: [
            { x: 10, y: 71 },
            { x: 20, y: 55 },
            { x: 30, y: 50 },
            { x: 40, y: 65 },
            { x: 50, y: 95 },
            { x: 60, y: 68 },
            { x: 70, y: 28 },
            { x: 80, y: 34 },
            { x: 90, y: 14 }
        ]
      }
      ]
    });

    chart.render();
    
    document.getElementById("button").addEventListener("click",function(){
    	chart.title.remove();
    });
  }
  </script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
  <div id="chartContainer" style="height: 275px; width: 100%;"></div>
  <div>
  	<button id="button">Remove Title</button>
  </div>
</body>
</html>

