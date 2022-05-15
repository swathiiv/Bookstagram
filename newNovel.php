<html>
  <head>
  <link rel = "stylesheet" type = "text/css" href = "style.css" />
    <style>
      body {
        background-image: url("images/slide-5.jpg");
      }
      .space{
          margin-top: 20px;
      }
      textarea{
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
         border: 2px solid #f6f6f6;
         -webkit-transition: all 0.5s ease-in-out;
         -moz-transition: all 0.5s ease-in-out;
         -ms-transition: all 0.5s ease-in-out;
         -o-transition: all 0.5s ease-in-out;
         transition: all 0.5s ease-in-out;
         -webkit-border-radius: 5px 5px 5px 5px;
         border-radius: 5px 5px 5px 5px;
      }
      .file{
        margin-top:7px;
        margin-left:180px;
      }
    </style>
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
          <li><a href="writerLogin.php">Home</a></li>
          <li><a href="newNovel.php">New Novel</a></li>
          <li><a href="updateNovel.php">Update Novel</a></li>
          <li><a href="index.php">logout</a></li>
      </div>
    </div>
  </nav>
  <body>    
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <form id="validate" method="POST">
        <div class="space">
          <input type="text" id="Name" class="fadeIn second" name="name" placeholder="Name of novel"/>
          <input type="text" id="Genre" class="fadeIn second" name="genre" placeholder="Genre"/>
          <textarea id ="textarea" rows="12" cols="50" class="fadeIn third" name="description" placeholder="Description..."></textarea>
          <input type="file" name="fileName" id="real-file" class="file"/>
          <input type="submit" class="fadeIn fourth" value="Submit" >
        </div>
        </form>
      </div>
    </div>
  </body>
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
   session_start();
   if(isset($_SESSION["Id"])){
     echo $_SESSION["Id"]; 
   }
   
   
   if(isset($_POST['name']) and isset($_POST['genre']) and isset($_POST['description']) ){
    $novelName = $_POST["name"];
    $number1= strpos($novelName,"'");
    $number2= strpos($novelName,"(");
    $number3= strpos($novelName,")");
    if($number1 > 0)
    $novelName[$number1-1] = '\\';
    if($number2 > 0)
    $novelName[$number2-1] = '\\';
    if($number3 > 0)
    $novelName[$number3-1] = '\\';
    $genre = $_POST["genre"];
    $img = $_POST["fileName"];
    $desc = $_POST["description"];
    $num1= strpos($desc,"'");
    $num2= strpos($desc,"(");
    $num3= strpos($desc,")");
    if($num1 > 0)
    $desc[$num1-1] = '\\';
    if($number2 > 0)
    $desc[$num2-1] = '\\';
    if($num3 > 0)
    $desc[$num3-1] = '\\';
    $writerId= $_SESSION["Id"];
    $sql = "INSERT INTO novel (WriterId, Name,Genre, Description, Image)
      VALUES ('$writerId','$novelName', '$genre','$desc','$img')";
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        echo $img;
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
   }

   ?>
</html>  
    