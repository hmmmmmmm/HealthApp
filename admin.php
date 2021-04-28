<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>A3 Health - Administrator Settings</title>
        <?php
        session_start();
        $link = mysqli_connect("localhost", "root", "", "health_app");
        if(!$_SESSION['user']) {
            header("location: index.php");
        }
        $user = $_SESSION['user'];
        $query = mysqli_query($link, "SELECT * FROM users, user_details WHERE username = '$user'");
        $row = mysqli_fetch_array($query);
        if($_SESSION['admin'] == 0) {
            header("location: home.php");
        }
        ?>
    </head>
    <body>
        <?php include 'header.php'?>
        <p>Administrator settings for <?php Print "$user"?>!</p>
    </body>
</html>