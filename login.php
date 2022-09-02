<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verwaltung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.scss">
  </head>
<body>
  
<?php 
  include "header.php";
  require_once "connection.php";
  session_start();

if(isset($_POST['submitlogin'])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $conn = new connection();
    
    $sql = "select * from users where username = ? and password = ?";
    $stmt = $conn->getConnection()->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
	$stmt->execute();
    $result = $stmt->get_result();
    $userarr = $result->fetch_array();

	if($userarr != null){
        $_SESSION['id'] = $userarr[0];
		$_SESSION['username'] = $userarr[1];
        $_SESSION['email'] = $userarr[2];
        $_SESSION['password'] = $userarr[3];
		header("location: login.php");
	}
	else{
		header("location: login.php");
		session_destroy();
		}
}

if(isset($_POST['newusernamesubmit']) && $_SESSION != null){
    $oldusername = $_SESSION["username"];
    $newusername = $_POST["newusername"];
    $conn = new connection();
    
    $sql = "update users set username = ? where username = ?";
    $stmt = $conn->getConnection()->prepare($sql);
    $stmt->bind_param("ss", $newusername, $oldusername);
	$stmt->execute();

	if($stmt){
		$_SESSION['username'] = $newusername;
		header("location: login.php");
	}
	else{
		header("location: login.php");
		}
}

if(isset($_POST['newpasswordsubmit']) && $_SESSION != null){
    $username = $_SESSION["username"];
    $newpassword = $_POST["newpassword"];
    $conn = new connection();
    
    $sql = "update users set password = ? where username = ?";
    $stmt = $conn->getConnection()->prepare($sql);
    $stmt->bind_param("ss", $newpassword, $username);
    $stmt->execute();

    if($stmt){
        $_SESSION['password'] = $newpassword;
        header("location: login.php");
    }
    else{
        header("location: login.php");
        }
}

if(isset($_POST['newemailsubmit']) && $_SESSION != null){
    $username = $_SESSION["username"];
    $newemail = $_POST["newemail"];
    $conn = new connection();
    
    $sql = "update users set email = ? where username = ?";
    $stmt = $conn->getConnection()->prepare($sql);
    $stmt->bind_param("ss", $newemail, $username);
    $stmt->execute();

    if($stmt){
        $_SESSION['email'] = $newemail;
        header("location: login.php");
    }
    else{
        header("location: login.php");
        }
}
?>

<form method="post" id="user">
    <div class="form-group">
    <label>Username</label>
    <input type="text" name="username" class="form-control" placeholder="Username">
    </div>
    <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <button type="submit" name="submitlogin" class="btn btn-primary">Login</button>
</form>

<form method="post" id="user">        
    <div class="form-group">       
        <?php
        if ($_SESSION != null) {
            echo "Welcome back ". $_SESSION["username"]. " 😎"; 
            echo "<br>Your Email: ". $_SESSION["email"];
            echo "<br>Your Password: ". $_SESSION["password"];
            echo "<br><a href='logout.php' class='button'>Logout</a>";
        } else {
            echo "Currently not logged in !";
        }
        ?><br><br>               
    </div>

    <div class="form-group">
        <label>Enter new Username:</label>
        <input type="text" name="newusername" class="form-control" placeholder="Username">
    </div>
    <div class="form-group">
        <button type="submit" name="newusernamesubmit" class="btn btn-primary">Change Username</button>
    </div><br>

    <div class="form-group">
        <label>Enter new Password:</label>
        <input type="password" name="newpassword" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <button type="submit" name="newpasswordsubmit" class="btn btn-primary">Change Password</button>
    </div><br>

    <div class="form-group">
        <label>Enter new Email-Adress:</label>
        <input type="email" name="newemail" class="form-control" placeholder="Email">
    </div>
    <div class="form-group">
        <button type="submit" name="newemailsubmit" class="btn btn-primary">Change Email</button>
    </div>
</form>
</body>
</html>


