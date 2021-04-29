<!DOCTYPE html>
<html lang="en">
    <head>
        <?php session_start();
        $link = mysqli_connect("localhost", "root", "", "health_app");
        if(!$_SESSION['user']) {
            header("location: index.php");
        }
        $user = $_SESSION['user'];
        $query = mysqli_query($link, "SELECT * FROM users, user_details WHERE username = '$user'");
        $row = mysqli_fetch_array($query);
        if($_SESSION['admin'] == 0) {
            header("location: home.php");
        } ?>
        <link href="default.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Hub - Manage All Data</title>
        <script>
            function toggleMusers() {
                var x = document.getElementById("manageuser");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }

            function toggleMuserdata() {
                var x = document.getElementById("manageuserdata");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }

            function toggleMhealthdata() {
                var x = document.getElementById("managehealthdata");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }

            function toggleMexercise() {
                var x = document.getElementById("manageexercise");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
    </head>
    <body>
        <?php include 'header.php'?>
        <p>Admin Hub - Manage all Data</p>
        
        <button onclick="toggleMusers()">Manage Users</button>
        <button onclick="toggleMuserdata()">Manage User Data</button>
        <button onclick="toggleMhealthdata()">Manage Health Data</button>
        <button onclick="toggleMexercise()">Manage Exercises</button>
        
        <div id="manageuser" style="display: none;"><br>
            <?php 
                $username = "root"; 
                $password = ""; 
                $database = "health_app"; 
                $mysqli = new mysqli("localhost", $username, $password, $database); 
                $query = "SELECT * FROM users";

                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                <tr> 
                    <td> USER ID </td> 
                    <td> Username </td> 
                    <td> Password </td> 
                    <td> Admin Rights </td> 
                </tr>';

                if ($result = $mysqli->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $uname = $row["username"];
                        $pword = $row["password"];
                        $admin = $row["admin"];
                        echo '<tr> 
                            <td>'.$id.'</td> 
                            <td>'.$uname.'</td> 
                            <td>'.$pword.'</td> 
                            <td>'.$admin.'</td> 
                            </tr>';
                    }
                echo '</table>';
                $result->free();
            }
            ?>
            <form action="" method="POST">
                Please enter a User ID to manage: <input type="text" name="mUserID" > <br>
                Input New Username: <input type="text" name="mUsername"> <br>
                Input New Password: <input type="text" name="mPassword"> <br>
                Select Admin Rights: <input type="text" name="mAdmin" > <br>
                <input type="submit" value="Update Details">
            </form>
        </div>
        <br>
        <div id="manageuserdata" style="display: none;">
            <br>
            <?php 
                $username = "root"; 
                $password = ""; 
                $database = "health_app"; 
                $mysqli = new mysqli("localhost", $username, $password, $database); 
                $query = "SELECT * FROM user_details";

                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr>
                    <td> USER ID </td> 
                    <td> First Name </td> 
                    <td> Surname </td> 
                    <td> Date of Birth </td> 
                    </tr>';

                if ($result = $mysqli->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $euserid = $row["user_id"];
                        $efirstname = $row["first_names"];
                        $esurname = $row["surname"];
                        $edob = $row["date_of_birth"];

                    echo '<tr>
                        <td>'.$euserid.'</td> 
                        <td>'.$efirstname.'</td> 
                        <td>'.$esurname.'</td> 
                        <td>'.$edob.'</td> 
                        </tr>';
                    }
                    echo '</table>';
                $result->free();
                }
            ?> 
            <br>
            <form action="" method="POST">
                User Id: <input type="text" name="" > <br>
                First Names: <input type="text" name="" > <br>
                Surname: <input type="text" name="" > <br>
                Date of Birth: <input type="date" name=""> <br>
                <input type="submit" value="Update Details">
            </form>
        </div>
        <br>
        <div id="managehealthdata" style="display: none;">
            <br>
            <?php 
                $username = "root"; 
                $password = ""; 
                $database = "health_app"; 
                $mysqli = new mysqli("localhost", $username, $password, $database); 
                $query = "SELECT * FROM health_data";

                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr>
                    <td> USER ID</td> 
                    <td> Timstamp</td> 
                    <td> Heart Rate</td> 
                    <td> Body Temp</td>  
                    <td> Blood Pressure</td>  
                    <td> Blood Oxygen</td>  
                    <td> Breathing Rate</td>  
                    <td> ECG Details</td> 
                    </tr>';

                if ($result = $mysqli->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $huserid = $row["user_id"];
                        $htimestamp = $row["timestamp"];
                        $hheartrate = $row["heartrate"];
                        $hhbodtemp = $row["bodtemp"];
                        $hblpressure = $row["blpressure"];
                        $hbloxygen = $row["bloxygen"];
                        $hbreathrate = $row["breathrate"];
                        $hecgdet = $row["ecgdet"];

                    echo '<tr>
                        <td>'.$huserid.'</td> 
                        <td>'.$htimestamp.'</td> 
                        <td>'.$hheartrate.'</td> 
                        <td>'.$hhbodtemp.'</td> 
                        <td>'.$hblpressure.'</td> 
                        <td>'.$hbloxygen.'</td> 
                        <td>'.$hbreathrate.'</td> 
                        <td>'.$hecgdet.'</td> 
                        </tr>';
                    }
                    echo '</table>';
                $result->free();
                }
            ?> 
            <br>
            <form action="" method="POST">
                User Id: <input type="text" name="" > <br>
                User Data Record: <input type="text" name="" > <br>
                Heartbeat/Pulse rate: <input type="text" name="" > <br>
                Body Temperature: <input type="text" name=""> <br>
                Blood Pressure: <input type="text" name=""> <br>
                Blood Oxygen: <input type="text" name="" > <br>
                Breathing/Respiration Rate: <input type="text" name="" > <br>
                ECG Details: <input type="text" name="" > <br>
                <input type="submit" value="Update Details">
            </form>
        </div>
        <br>
        <div id="manageexercise" style="display: none;"> <br>
            <form action="" method="POST">
                Exercise ID <input type="text" name="exercise_id" > <br>
                <input type="submit" value="Update Details">
            </form>
        </div>
    </body>
</html>