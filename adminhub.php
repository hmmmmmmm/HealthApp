<!DOCTYPE html>
<html lang="en">
    <head>
        <?php session_start();
        $link = new mysqli("localhost", "root", "", "health_app");
        if(!$_SESSION['user']) {
            header("location: index.php");
        }
        $user = $_SESSION['user'];
        $query = mysqli_query($link, "SELECT * FROM users, user_details WHERE username = '$user'");
        $row = mysqli_fetch_array($query);
        if($_SESSION['admin'] == 0) {
            header("location: home.php");
        } 
        
        $users = array();
        $query = "SELECT * FROM users";
        if ($result = $link->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $uname = $row["username"];
                $pword = $row["password"];
                $admin = $row["admin"];
                
                $users[] = $row;
            }
        }
        
        $user_details = array();
        $query = "SELECT * FROM user_details";
        if ($result = $link->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $euserid = $row["user_id"];
                $efirstname = $row["first_names"];
                $esurname = $row["surname"];
                $edob = $row["date_of_birth"];
                
                $user_details[] = $row;
            }
        }

        $health_data = array();
        $query = "SELECT * FROM health_data";
        if ($result = $link->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $huserid = $row["user_id"];
                $htimestamp = $row["timestamp"];
                $hheartrate = $row["heartrate"];
                $hhbodtemp = $row["bodtemp"];
                $hblpressure = $row["blpressure"];
                $hbloxygen = $row["bloxygen"];
                $hbreathrate = $row["breathrate"];
                $hecgdet = $row["ecgdet"];

                $health_data[] = $row;
            }
        }

        $exercise_data = array();
        $query = "SELECT * FROM exercise_data";
        if ($result = $link->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $euserid = $row["user_id"];
                $etimestamp = $row["timestamp"];
                $ename = $row["ename"];
                $etime = $row["etime"];
                $enotes = $row["enotes"];
                $eid = $row["exercise_id"];

                $exercise_data[] = $row;
            }
        }

        $reminders = array();
        $query = "SELECT * FROM reminders";
        if ($result = $link->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $ruserid = $row["user_id"];
                $rtimestamp = $row["timestamp"];
                $rdate = $row["reminderdate"];
                $rdetails = $row["reminderdetails"];
                $rid = $row["reminder_id"];

                $reminders[] = $row;
            }
        }

        ?>
        <link href="default.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Hub - Manage All Data</title>
    </head>
    <body>
        <?php include 'header.php'?>
        <p>Admin Hub - Manage all Data</p>
        
        <button onclick="toggleMusers()">Manage Users</button>
        <button onclick="toggleMuserdata()">Manage User Data</button>
        <button onclick="toggleMhealthdata()">Manage Health Data</button>
        <button onclick="toggleMexercise()">Manage Exercises</button>
        <button onclick="toggleMreminders()">Manage Reminders</button>
        
        <div id="manageuser" style="display: none;"><br>
            <?php 
                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                <tr> 
                    <td> USER ID </td> 
                    <td> Username </td> 
                    <td> Password </td> 
                    <td> Admin Rights </td> 
                </tr>';

                foreach($users as $row){
                    echo '<tr>
                        <td>'.$row['id'].'</td> 
                        <td>'.$row['username'].'</td> 
                        <td>'.$row['password'].'</td> 
                        <td>'.$row['admin'].'</td> 
                        </tr>';
                }
                echo '</table>';
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
                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr>
                    <td> USER ID </td> 
                    <td> First Names </td> 
                    <td> Surname </td> 
                    <td> Date of Birth </td> 
                    </tr>';

                foreach($user_details as $row){
                    echo '<tr>
                        <td>'.$row['user_id'].'</td> 
                        <td>'.$row['first_names'].'</td> 
                        <td>'.$row['surname'].'</td> 
                        <td>'.$row['date_of_birth'].'</td> 
                        </tr>';
                }
                echo "</table>";
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
                
                foreach($health_data as $row){

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
        <div id="manageexercise" style="display: none;">
            <br>
            <?php 
                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr>
                    <td>Exercise ID</td>
                    <td>USER ID</td>
                    <td>Timestamp</td>
                    <td>Exercise Name</td>
                    <td>Exercise Length</td>
                    <td>Exercise Notes</td>
                    </tr>';
                
                foreach($exercise_data as $row){

                    $euserid = $row["user_id"];
                    $etimestamp = $row["timestamp"];
                    $ename = $row["ename"];
                    $etime = $row["etime"];
                    $enotes = $row["enotes"];
                    $exercise_id = $row["exercise_id"];

                    echo '<tr>
                        <td>'.$exercise_id.'</td>
                        <td>'.$euserid.'</td>
                        <td>'.$etimestamp.'</td>
                        <td>'.$ename.'</td>
                        <td>'.$etime.'</td>
                        <td>'.$enotes.'</td>
                        </tr>';
                }
                echo '</table>';
            ?> 
            <form action="" method="POST">
                Exercise ID <input type="text" name="exercise_id" > <br>
                <input type="submit" value="Update Details">
            </form>
        </div>
        <br>
        <div id="managereminders" style="display: none;">
            <br>
            <?php 
                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr>
                    <td>Reminder ID</td>
                    <td>USER ID</td> 
                    <td>Timestamp</td> 
                    <td>Reminder Date</td> 
                    <td>Reminder Details</td>
                    </tr>';
                
                foreach($reminders as $row){

                    $ruserid = $row["user_id"];
                    $rtimestamp = $row["timestamp"];
                    $reminderdate = $row["reminderdate"];
                    $reminderdetails = $row["reminderdetails"];
                    $reminder_id = $row["reminder_id"];

                    echo '<tr>
                        <td>'.$reminder_id.'</td>
                        <td>'.$ruserid.'</td>
                        <td>'.$rtimestamp.'</td>
                        <td>'.$reminderdate.'</td>
                        <td>'.$reminderdetails.'</td>
                        </tr>';
                }
                echo '</table>';
            ?> 
            <form action="" method="POST">
                Reminder ID <input type="text" name="" > <br>
                <input type="submit" value="Update Details">
            </form>
        </div>
    </body>
    <script src="toggledisplay.js"></script>
</html>