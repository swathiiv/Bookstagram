<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <style>

  h4{

    margin-left:50px;

    margin-right:50px;

    margin-top:20px;

  }

  h2{

    margin-left:505px;

    margin-top:20px;

  }

  .button {

  background-color: #4CAF50;

  border: none;

  color: white;

  padding: 10px 32px;

  text-align: center;

  text-decoration: none;

  display: inline-block;

  font-size: 20px;

  margin: 2px 2px;

  cursor: pointer;

}

.center{

   margin-left: 610px;

}



  </style>

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

          <li><a href="readerMain.php">Home</a></li>

          <li><a href="Review.php">Review</a></li>

          <li><a href="index.php">logout</a></li>

         

      </div>

    </div>

</nav>

<body>

<form method="POST" id="validate">

<div class="center">

<input type="submit" class="button" name="previous" value="<">

<input type="submit" class="button" name="next" value=">">

</div>

</form>

<?php

ob_start();

session_start();

$name = $_SESSION["chapterName"];

$novelId=$_SESSION["novelId"];

$servername = "localhost";

$username = "root";

$password = "";

$dbname = "Bookstagram1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

  die("Connection failed: " . $conn->connect_error);

}

$ret=mysqli_query($conn, "SELECT Content, ChapterName FROM chapter WHERE ChapterNumber='$name' AND NovelId='$novelId'") or die("Could not execute query: " .mysqli_error($conn));

$row = mysqli_fetch_assoc($ret);

echo "<h2>Chapter ".$name."-".$row["ChapterName"]."</h2>";

echo "<h4>".$row["Content"]."</h4>";

$sql1 = "SELECT COUNT(ChapterNumber) as total FROM chapter WHERE  NovelId='$novelId'";

$rest = mysqli_query($conn, $sql1);

$rws = mysqli_fetch_assoc($rest);

$no= $rws["total"];

?>

<br/><br/>

</body>

<?php
 
  global $name;
  global $no;
  if(isset($_POST["next"])){

    $name = $name + 1;

    if($name < $no+1 ){

    $_SESSION["chapterName"] = $name;

    $_SESSION["novelId"]=$novelId;

    header("Location:Chapters.php");

    }

  }

  if(isset($_POST["previous"])){

    $name = $name - 1;

    if($name > 0){

    $_SESSION["chapterName"] = $name;

    $_SESSION["novelId"]=$novelId;

    header("Location:Chapters.php");

    }

  }  

?>