<?php
session_start();
$id = $_SESSION['id'];
ob_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Bookstagram1";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
		} 
$x = array();
$y = array();
$dataPoints = array();
$j = 0;
$montharray= ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  for($i= 0; $i < 13;$i++){
      $ret1 = mysqli_query($conn,"SELECT Month FROM month WHERE Id='$i+1'");
      $row1 = mysqli_fetch_assoc($ret1);
      $monthname= $row1["Month"];
      $sql = "SELECT COUNT(Comment) as total FROM review WHERE Month='$monthname' and NovelId='$id'";
      $result = mysqli_query($conn, $sql);
      $rw = mysqli_fetch_assoc($result);
      $no= $rw["total"];
      if($i==0){
		    continue;
	    }
	    $x[$j] = $no;
	    $y[$j] = $monthname;
	    $j = $j + 1;  
  }
for($i = 0; $i < sizeof($y); $i = $i + 1){
   $dataPoints[$i] = array("y" => $x[$i], "label" => $y[$i]);
}
$dataPoint = array();
$m = array();
$n = array();
$k = 0;

for($i= 0; $i < 6;$i++){
  $results = mysqli_query($conn,"SELECT Rating FROM rating WHERE Id='$i+1'");
  $row2 = mysqli_fetch_assoc($results);
  $rating = $row2["Rating"];
  if($rating == null){
    continue;
  }
  $sql1 = "SELECT COUNT(Comment) as ttl FROM review WHERE Comment='$rating' and NovelId='$id'";
  $resultset = mysqli_query($conn, $sql1);
  $rw1 = mysqli_fetch_assoc($resultset);
  $number = $rw1["ttl"];
  if($i==0){
    continue;
  }
  $m[$k] = $number;
  $n[$k] = $rating;
  $k = $k + 1;  
}
for($i = 0; $i < sizeof($n); $i = $i + 1){
  $dataPoint[$i] = array("label"=>$n[$i], "y"=>$m[$i]);
}
?>

<html>
<head>
<style>
.charts{
 margin-left:300px;
 margin-top:50px;
}

</style>
<script>
 window.onload = function ()  {
 
var chart = new CanvasJS.Chart("chartContainer1", {
	title: {
		text: "Readers Per Month"
	},
	axisY: {
		title: "Number of Readers"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

var chart = new CanvasJS.Chart("chartContainer2", {
   animationEnabled: true,
   exportEnabled: true,
   title:{
     text: "Rating"
   },
   subtitles: [{
     text: ""
   }],
   data: [{
     type: "pie",
     showInLegend: "true",
     legendText: "{label}",
     indexLabelFontSize: 16,
     indexLabel: "{label} - #percent%",
     yValueFormatString: "##0",
     dataPoints: <?php echo json_encode($dataPoint, JSON_NUMERIC_CHECK); ?>
   }]
 });
 chart.render();
 

 }
</script>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="#">Bookstagram</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="readerMain.php">Novels</a></li>
          <li><a href="Review.php">Review</a></li>
          <li><a href="index.php">Home</a></li>
      </div>
    </div>
</nav>
<body>
<div class="charts">
<div id="chartContainer1" style="height: 300px; width: 60%;"></div><br/>
<script src="canvasjs/canvasjs.min.js"></script>
<div id="chartContainer2" style="height: 300px; width: 60%;"></div>
<script src="canvasjs/canvasjs.min.js"></script>
</div>
</body>
</html>

                                