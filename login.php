<!DOCTYPE html>
<html lang="en">
    <head>
        <?php session_start(); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>A3 Health - Login</title>
    </head>
    <body>
        <?php include 'header.php'?>
		<section>
       <div class="b3">
        <p>Please login to your A3 Health account</p>
		<br>
        <form action="login.php" method="POST" id="myForm">
            <div class="form-group">
			Username: <input type="text" name="username" required="required"> <br>
			</div>
			<br>
			<div class="form-group">
            Password: <input type="password" name="password" required="required"> <br>
			</div>
			<br>
            <input type="submit" value="Login" class="btnstyle2">
        </form>
		</div>
		</section>
    </body>
</html>

<?php
$link = new mysqli("localhost", "root", "", "health_app");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $bool = true;

    $query = mysqli_query($link, "SELECT * FROM users WHERE username='$username'");
    $row = mysqli_fetch_array($query);

    if(mysqli_num_rows($query) > 0) {
        if(($username == $row['username']) && password_verify($password, $row['password'])){
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['admin'] = $row['admin'];
            header ("location: home.php");
        } else {
            echo '<script>alert("Incorrect password");</script>';
            echo '<script>window.location.assign("login.php");</script>';
        }
    } else {
        echo '<script>alert("Incorrect username");</script>';
        echo '<script>window.location.assign("login.php");</script>';
    }
}
?>