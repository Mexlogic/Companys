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
?>

<form method="post" action="registration.php" id="user">
  <div class="form-group">
    <label>Username</label>
    <input type="text" name="username" class="form-control" placeholder="Username" required>
  </div>
  <div class="form-group">
    <label>Email address</label>
    <input type="email" name="email" class="form-control" placeholder="Email" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
  </div>
  <button type="submit" name="submitregistration" class="btn btn-primary">Submit</button>
</form>

<?php 
    require_once "user.php"; 
    require_once "connection.php"; 

    if(isset($_POST['submitregistration'])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
    
        $tempuser = new user($username, $email, $password);
        $tempuser->submit();
        $_POST = array();
    }
?>

</body>

</html>
