<head>  
  <style>
    select{
    background-color: #f6f6f6;
    border: none;
    margin-left:500px;
    margin-top:300px;
    color: #0d0d0d;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 5px;
    width: 50%;
    height: 6%;
    border: 2px solid #f6f6f6;
    -webkit-transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
    -webkit-border-radius: 5px 5px 5px 5px;
     border-radius: 5px 5px 5px 5px;
   }
   input[type=text]{
    background-color: #f6f6f6;
    border: none;
    color: #0d0d0d;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 5px;
    width: 50%;
    height: 6%;
    border: 2px solid #f6f6f6;
    -webkit-transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
    -webkit-border-radius: 5px 5px 5px 5px;
     border-radius: 5px 5px 5px 5px;
   }
   input[type=submit]{
        background-color: #56baed;
        color: white;
        text-align: center;
        text-decoration: none;
        -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
         box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
        -webkit-border-radius: 5px 5px 5px 5px;
        text-transform: uppercase;
        width:50%;
        height:6%;
      }
   .content{
    margin-left:470px;
    margin-top:20px;
   }
   .fa {
  padding: 20px;
  font-size: 30px;
  width: 50px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
}

.fa:hover {
    opacity: 0.7;
}

.fa-twitter {
  background: #55ACEE;
  color: white;
}
  </style>
  <script>
 function display () {
 
   var chart = new CanvasJS.Chart("chartContainer", {
	  title: {
		  text: "Reviews"
	 },
 	 axisY: {
		  title: "Number of Push-ups"
	 },
	 data: [{
		  type: "line",
		  dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	 }]
});
chart.render();
 
}
</script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
          <li><a href="#">Review</a></li>
          <li><a href="index.php">Home</a></li>
      </div>
    </div>
</nav>
<body>
<form method="POST" id="validate">
<div class="content">
<select name="select"> 
     <?php
        ob_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Bookstagram1";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
        } 
        $result = array();
        $namearray = array();
        $idarray= array();
        if($namearray=mysqli_query($conn, "SELECT Name FROM novel") or die("Could not execute query: " .mysqli_error($conn)))
        while ($row=mysqli_fetch_row($namearray)){
          echo "<option>";
          for($b=0;$b <= sizeof($row);$b++){
             if(!isset($row[$b]))
                continue;
             echo $row[$b];   
          } 
         echo "</option>";
        }
     ?>
     </select><br/><br/>
     <select name="review">
        <option>Bad</option>
        <option>Average</option>
        <option>Good</option>
        <option>Very Good</option>
        <option>Excellent</option>
     </select><br/><br/>
     <select name="month">
       <option>January</option>
       <option>February</option>
       <option>March</option>
       <option>April</option>
       <option>May</option>
       <option>June</option>
       <option>July</option>
       <option>August</option>
       <option>September</option>
       <option>October</option>
       <option>November</option>
       <option>December</option>
     </select><br/><br/>
     <input type="submit" name="sbmt" value="Submit"><br/><br/>
     <select name="select1">
     <?php
        $numarray = array();
        if($numarray=mysqli_query($conn, "SELECT Name FROM novel") or die("Could not execute query: " .mysqli_error($conn)))
        while ($row1=mysqli_fetch_row($numarray)){
          echo "<option>";
          for($b=0;$b <= sizeof($row1);$b++){
             if(!isset($row1[$b]))
                continue;
             echo $row1[$b];   
          } 
         echo "</option>";
        }
     ?>
     </select><br/><br/>
     <input type="submit" name="submit" value="View Popularity"><br/><br/>
     <input type="text" placeholder="Comment on twitter" name="tweet">
     <input type="submit" name="twitter" value="tweet">
</div>
</form>
<?php
 if(isset($_POST["sbmt"])){
     if(isset($_POST["select"]) and isset($_POST["review"]) and isset($_POST["month"])){
        $name=$_POST["select"];
        $ret = mysqli_query($conn,"SELECT Id FROM novel WHERE Name='$name'");
        $row = mysqli_fetch_assoc($ret);
        $id = $row["Id"];
        $review = $_POST["review"];
        $month=$_POST["month"];
        $sql = "INSERT INTO review (NovelId,Comment, Month)
                VALUES ('$id','$review','$month')";
        if ($conn->query($sql) === TRUE) {
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
  }
  if(isset($_POST["submit"])){
    if(isset($_POST["select1"])){
      $name=$_POST["select1"];
      $ret = mysqli_query($conn,"SELECT Id FROM novel WHERE Name='$name'");
      $row = mysqli_fetch_assoc($ret);
      $id = $row["Id"];
      session_start();
      $_SESSION['id'] = $id;
      header("Location:net.php");
    }
  }
  if(isset($_POST["twitter"]) and isset($_POST["tweet"])){
    $name= $_POST["tweet"];
    $last_line = system("python sample.py '$name'", $retval);
  }
  
?>
