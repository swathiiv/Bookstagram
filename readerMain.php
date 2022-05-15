<head>
<style>
  body {
    background-color:blue;
  }
  
  table{
    margin-top: 40px;
    margin-left: 50px;
  }
  input[type=text] {
    background-color: #f6f6f6;
    border: none;
    color: #0d0d0d;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 5px;
    width: 85%;
    height:6%;
    border: 2px solid #f6f6f6;
  }
.holder{
  display:inline;
  margin-left:70px;
}
.select-holder{
  display:inline;
  margin-left:70px;
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
  width:6%;
  height:6%;
}
select{
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  height: 7.5%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}
img{
  margin-top:20px;
  margin-left:20px;
}
tr{
  margin-left:40px;
}
* {
  box-sizing: border-box;
}

body {
  font-family: Arial;
  font-size: 17px;
}

.container {
  position: relative;
  max-width: 800px;
  margin: 0 auto;
}

.container img {vertical-align: middle;}

.container .content {
  position: absolute;
  bottom: 0;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}

</style>
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
  <form method="POST" id="validate">
    <div class="holder">
      <input type="text" name="search" placeholder="Search..">
      <input type="submit" name="button" value="search"> 
      <br/><br/>
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
        $result = array();
        $namearray = array();
        $idarray= array();
     ?>
     </div>
     <table>
     <?php 
       $idarray=mysqli_query($conn,"SELECT Id FROM novel")or die("Could not execute query: " .mysqli_error($conn));
       if($result=mysqli_query( $conn, "SELECT Image FROM novel") or die("Could not execute query: " .mysqli_error($conn)))
        while ($row=mysqli_fetch_row($result) and $id=mysqli_fetch_row($idarray)){
          echo "<tr>";
          for($b=0;$b<=sizeof($row);$b++){
            if(!isset($row[$b]))
              continue;
              echo '&nbsp;&nbsp;<a href="'.$href.$id[$b].'"><img src="'.$pathx.$row[$b].'"></a>&nbsp;&nbsp;'; 
          }
        echo "</tr>";
        }
        ?>
     </table><br/><br/>
     
    </div>
  </form>
</body>
<?php 
session_start();
if(isset($_POST["search"])){
  $_SESSION["search"] = $_POST["search"];
  header("Location:search.php");
}
?>

