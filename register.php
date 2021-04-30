<!DOCTYPE html>
<html lang="en">
    <head>
        <?php session_start(); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>A3 Health - Register</title>
    </head>
    <body>
        <?php include 'header.php'?>
		<section>
       <div class="b3">
        <p>Register for an A3 Health account</p>
		<br>
        <form action="register.php" method="POST" id="myForm">
		<div class="form-group">
            Username: <input type="text" name="username" required="required"> <br>
			</div>
			<br>
			<div class="form-group">
            Password: <input type="password" name="password" required="required"> <br>
			</div>
			<br>
            <input type="submit" value="Register" class="btnstyle2">
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

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = mysqli_query($link, "SELECT * from users");
    while($row = mysqli_fetch_array($query)){
        if($username == $row['username']) {
            $bool = false;
            echo '<script>alert("Username already in use");</script>';
            echo '<script>window.location.assign("register.php");</script>';
        }
    }

    if($bool){
        mysqli_query($link, "INSERT INTO users (username, password) VALUES ('$username', '$hash')");
        mysqli_query($link, "INSERT INTO user_details (user_id) SELECT id FROM users WHERE username='$username'");
        echo '<script>alert("Successfully registered!");</script>';
        echo '<script>window.location.assign("register.php");</script>';
    }
}
?>