<!DOCTYPE html>
<html lang="en">
    <head>
        <?php session_start(); ?>
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

            function toggleMexercise() {
                var x = document.getElementById("manageexercises");
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
        </script>
    </head>
    <body>
        <?php include 'header.php'?>
        <p>Admin Hub - Manage all Data</p>
        
        <button onclick="toggleMusers()">Manage Users</button>
        <button onclick="toggleMuserdata()">Manage User Data</button>
        <button onclick="toggleMexercise()">Manage Exercises</button>
        
        <div id="manageuser"><br>
            <form action="" method="POST">
                Please enter a User ID to manage: <input type="text" name="mUserID" > <br>
                Input New Username: <input type="text" name="mUsername"> <br>
                Input New Password: <input type="text" name="mPassword"> <br>
                Select Admin Rights: <input type="text" name="mAdmin" > <br>
                <input type="submit" value="Update Details">
            </form>
            <?php 
                $username = "root"; 
                $password = ""; 
                $database = "health_app"; 
                $mysqli = new mysqli("localhost", $username, $password, $database); 
                $query = "SELECT * FROM users";

                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                <tr> 
                    <td> <font face="Arial">USER ID</font> </td> 
                    <td> <font face="Arial">Username</font> </td> 
                    <td> <font face="Arial">Password</font> </td> 
                    <td> <font face="Arial">Admin Rights</font> </td> 
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
                $result->free();
            }
            ?>
        </div>
        <br>
        <div id="manageuserdata">
            <br>
            <?php 
                $username = "root"; 
                $password = ""; 
                $database = "health_app"; 
                $mysqli = new mysqli("localhost", $username, $password, $database); 
                $query = "SELECT * FROM user_details";

                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr>
                    <td> <font face="Arial">USER ID</font> </td> 
                    <td> <font face="Arial">First Name</font> </td> 
                    <td> <font face="Arial">Surname</font> </td> 
                    <td> <font face="Arial">Date of Birth</font> </td> 
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
        <div id="manageexercises"> <br>
            <form action="" method="POST">
                Excercise ID <input type="text" name="reminderdate" > <br>
                <input type="submit" value="Update Details">
            </form>
        </div>
    </body>
</html>