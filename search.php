<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<?php
session_start();
$search= $_SESSION["search"];
?>
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
          <li><a href="readerMain.php">Home</a></li>
          <li><a href="#">Review</a></li>
          <li><a href="index.php">logout</a></li>
      </div>
    </div>
</nav>
<body>
<?php
    ob_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Bookstagram1";
    $pathx='images/';
    $href="read.php?id=";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $idArray = array();
    $nameArray = array();
    $idArray = mysqli_query($conn, "SELECT Id from novel WHERE Name LIKE '%$search%'") or die("Could not execute query: " .mysqli_error($conn));
    $nameArray = mysqli_query($conn,"SELECT Image from novel WHERE Name LIKE '%$search%'") or die("Could not execute query: " .mysqli_error($conn));
    while($row=mysqli_fetch_row($nameArray) and $id= mysqli_fetch_row($idArray) ){
      for($b=0;$b<=sizeof($row);$b++){
        if(!isset($row[$b]) and !isset($id[$b]))
              continue;
        echo '&nbsp;&nbsp;<a href="'.$href.$id[$b].'"><img src="'.$pathx.$row[$b].'"></a>&nbsp;&nbsp;'; 
      }
    }
?>
</body>