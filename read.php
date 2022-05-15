<head>
   <style>
    img {
     
   }
   h4{
     margin-left:40px;
     margin-right:50px;
   }
   h3{
     margin-left:500px;
     margin-top:2px;
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
       width: 78%;
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
      .select-holder{
       display:inline;
       margin-left:100px;
       margin-top:20px;
      
      }
      .desc{
        margin-left:70px;
        margin-top:10px;
      }
      .padding1{
        padding:35px;
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
      .service {
       width: 70%;
       height: 220px;
       margin-left: 100px;
       text-align: center;
       border: 1px solid #ddd;
       -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
}

.service .icon-holder {
    position: relative;
    top: 50px;
    display: inline-block;
    margin-bottom: 0px;
    padding: 10px;
    background: #F7F8F9;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    font-size: 50px;
    color: #9B59B6;
}

.service .heading {
    position: relative;
    top: 80px;
    -webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.service:hover {
    border-color: #9B59B6;
}

.service:hover .icon-holder {
    top: -50px;
}

.service:hover .heading {
    top: -30px;
}

.service .description {
    width: 80%;
    margin: 0 auto;
    opacity: 0;
    -webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
    -webkit-transform: scale(0);
    -ms-transform: scale(0);
    transform: scale(0);
}

.service:hover .description {
    opacity: 1;
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
}

</style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>  
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.css" rel="stylesheet">
    
    <!--Template Styles-->
    <link href="css/scheme/purple.css" rel="stylesheet">
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
<div class="desc">
<?php
session_start();
ob_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Bookstagram1";
$pathx='images/';
$id = htmlspecialchars($_GET["id"]);
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
$ret=mysqli_query($conn, "SELECT Image, Description, Name FROM novel WHERE Id='$id'") or die("Could not execute query: " .mysqli_error($conn));
$row = mysqli_fetch_assoc($ret);
$img = $row["Image"];
$desc= $row["Description"];
$name = $row["Name"];
echo '<h3>'.$name.'</h3>';
echo '<h3><img src="'.$pathx.$img.'"></h3><br/>';
echo '<section id="services" class="services">
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="service">
                    <div class="icon-holder">
                        <i class="fa fa-paper-plane"></i>
                    </div>
                    <p class="description">'.$desc.'</p>
            </div>
            
        </div>
    </div> 
          
</div>
</section>';
?>
</div>
<br/><br/><br/>
<div class="select-holder">
  <select name="select" class="padding1"> 
  <?php
    $chapter=0;
    $chaptersName = array();
    $chapterNumbers=array();
    $chaperId =array();
    $chaperId =mysqli_query($conn, "SELECT Id FROM chapter WHERE NovelId='$id'") or die("Could not execute query: " .mysqli_error($conn));
    $chapterNumbers =mysqli_query($conn, "SELECT ChapterNumber FROM chapter WHERE NovelId='$id'") or die("Could not execute query: " .mysqli_error($conn));
    if($chaptersName=mysqli_query($conn, "SELECT ChapterName FROM chapter WHERE NovelId='$id'") or die("Could not execute query: " .mysqli_error($conn)))
    while ($row=mysqli_fetch_row($chaptersName) and $row1= mysqli_fetch_row($chapterNumbers) and $row2=mysqli_fetch_row($chaperId)){
      echo "<option>";
      for($b=0;$b <= sizeof($row);$b++){
         if(!isset($row[$b]))
            continue;
         echo $row1[$b]."-".$row[$b]; 
      } 
     echo "</option>";
    }
  ?>
  </select>
</div>
<input type="submit" name="button">
</form>
<?php
  if(isset($_POST["button"])){
    $chapter=explode("-", $_POST["select"]);
    $_SESSION["chapterName"] = $chapter[0];
    $_SESSION["novelId"] = $id;
    header("Location:Chapters.php");
  }
    
?>