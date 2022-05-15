<head>
  <style>
    html {
      background-color:#d1d1e3;
    }
    .space{
      margin-top: 20px;
    }
    table{
      margin-top: 40px;
      margin-left: 50px;
    }
  </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body> 
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
        <li class="active"><a href="writerLogin.php">Home</a></li>
        <li><a href="newNovel.php">New Novel</a></li>
        <li><a href="updateNovel.php">Update Novel</a></li>
        <li><a href="index.php">logout</a></li>
    </div>
  </div>
</nav>
     <table>
     <?php 
       ob_start();
       session_start();
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "Bookstagram1";
       $pathx='images/';
       $WId = $_SESSION["Id"];
       $conn = new mysqli($servername, $username, $password, $dbname);
       if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
       } 
       $result = array();
       if($result=mysqli_query( $conn, "SELECT Image FROM novel WHERE WriterId='$WId'") or die("Could not execute query: " .mysqli_error($conn)))
        while ($row=mysqli_fetch_row($result)){
           echo "<tr>";
           for($b=0;$b <= sizeof($row);$b++){
              if(!isset($row[$b]))
               continue;
              echo '&nbsp;&nbsp;<img src="'.$pathx.$row[$b].'">&nbsp;&nbsp;';   
            }
           echo "</tr>";
        }
        ?>
     </table><br/><br/> 
    </body>
</html>
