<html>
<head>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
<style>
    body {
      background-image: url("images/slide-7.jpg");
      
    }
    .space{
      margin-top: 20px;
    }
    .select{
        margin-right:70px;
    }
    h3{
        margin-top: 10px;
        margin-right: 200px;
        color: white;
    }
    .file{
      margin-top:7px;
      margin-left:180px;
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
      h5{
         color:white;
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
        <form method="POST" id="validate">
          <div class="space">
          <select name="select">
          <?php 
            ob_start();
            session_start();
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Bookstagram1";
            $WId=$_SESSION["Id"];
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 
            $result = array();
            if($result=mysqli_query($conn, "SELECT Name FROM novel WHERE WriterId='$WId'") or die("Could not execute query: " .mysqli_error($conn)))
            while ($row=mysqli_fetch_row($result)){
              echo "<option>";
              for($b=0;$b <= sizeof($row);$b++){
                 if(!isset($row[$b]))
                    continue;
                 echo $row[$b];   
              } 
             echo "</option>";
            }
          ?>
         </select>
         <input type="text" id="Chapter Number" class="fadeIn second" name="Number" placeholder="Chapter Number">
         <input type="text" id="Chapter Title" class="fadeIn second" name="Title" placeholder="Chapter Title">
         <textarea id ="textarea" rows="12" cols="50" class="fadeIn third" name="content" placeholder="Key in your thoughts"></textarea><br/><br/>
         <input type="submit" name="submit" class="fadeIn fourth" value="Submit">
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
     if(isset($_SESSION["Id"])){
       echo $_SESSION["Id"]; 
     }
     if(isset($_POST["submit"])){
       $novelName = $_POST["select"];
       $ret=mysqli_query( $conn, "SELECT Id FROM novel WHERE Name='$novelName'") or die("Could not execute query: " .mysqli_error($conn));
       $row = mysqli_fetch_assoc($ret);
       $novelName = $row["Id"];
       $chapterName = $_POST["Title"];
       $number1= strpos($chapterName,"'");
       $number2= strpos($chapterName,"(");
       $number3= strpos($chapterName,")");
       if($number1 > 0)
       $chapterName[$number1-1] = '\\';
       if($number2 > 0)
       $chapterName[$number2-1] = '\\';
       if($number3 > 0)
       $chapterName[$number3-1] = '\\';
       $chapterNumber = $_POST["Number"];
       $content = $_POST["content"];
       $num1= strpos($content,"'");
       $num2= strpos($content,"(");
       $num3= strpos($content,")");
       if($num1 > 0)
       $content[$num1-1] = '\\';
       if($number2 > 0)
       $content[$num2-1] = '\\';
       if($num3 > 0)
       $content[$num3-1] = '\\';
       if($novelName && $chapterName && $chapterNumber && $content){
        $sql = "INSERT INTO chapter (Content, NovelId,ChapterName, ChapterNumber)
        VALUES ('$content', '$novelName', '$chapterName', '$chapterNumber')";
        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
     }
    }
     
  ?>
</html>
    