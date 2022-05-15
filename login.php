<html>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
<style>
    html {
      background-image: url("images/slide-1.jpg");
    }
</style>
    
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <form  method="POST">
        <div class="space">
          <input type="text" name="name" id="Name" class="fadeIn second" placeholder="User Name">
          <input type="password" id="password" name="pswd" class="fadeIn third" placeholder="Password">
          <input type="submit" name="submit" class="fadeIn fourth" value="LogIn"><br/>
        </div>
        </form>
      </div>
    </div>
  <?php
   ob_start();
   session_start(); 
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "Bookstagram1";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   } 
  if( isset($_POST['name']) and isset($_POST['pswd']) ) {
		$user=$_POST['name'];
    $pass=$_POST['pswd'];
		$ret=mysqli_query( $conn, "SELECT * FROM user WHERE Name='$user' AND pswd='$pass' ") or die("Could not execute query: " .mysqli_error($conn));
    $row = mysqli_fetch_assoc($ret);
    $_SESSION["Id"] = $row["Id"];
		if(count($row) > 0){
      header("Location: writerLogin.php");
		}
		else
		{
			echo "Not found";
		}
}
?>
</html>
