<?php
if(isset($_SESSION['admin']) && $_SESSION['admin']){
    $adminbutton='<li><a href="adminhub.php">Admin</a></li>';
} else {
    $adminbutton='';
}

if(isset($_SESSION['user'])){
    $navbuttons='<li><a href="health.php">Health Data</a></li> <li><a href="logout.php">Logout</a></li>';
} else {
    $navbuttons='<li><a href="register.php">Register</a></li> <li><a href="login.php">Login</a></li>';
}
?>
<link href="default.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="menu-icon">
        <span class="fas fa-bars"></span>
    </div>

    <div class="logo">
        A3 Health
    </div>

    <div class="nav-items">
        <li><a href="home.php">Home</a></li>
        <?php echo $adminbutton ?>
        <?php echo $navbuttons ?>
    </div>

    <script>
        const menuBtn = document.querySelector(".menu-icon span");
        const items = document.querySelector(".nav-items");

        menuBtn.onClick = ()=>{
            items.classList.add("active");
            menuBtn.classList.add("hide");
        }
    </script>
</nav>