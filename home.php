<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>A3 Health - Homepage</title>
        <?php
        session_start();
        if(!$_SESSION['user']) {
            header("location: index.php");
        }
        $user = $_SESSION['user'];
        ?>
    </head>
    <body>
        <?php include 'header.php'?>
        <div class="welcomeMessage"<p>Welcome to A3 Health, <?php Print "$user"?>!</p></div>
		
		<div class="b4">
		<img src="healthBanner.png" alt="webpage banner" class="logo"> 
		</div>
		
		
    </body>
</html>