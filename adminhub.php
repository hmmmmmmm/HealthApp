<!DOCTYPE html>

<! -- done-->
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
        $link->close();
        ?>
        <link href="default.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Hub - Manage All Data</title>
    </head>
    <body>
	
        <?php include 'header.php'?>
		
        <div class="o"><p>Admin Hub - Manage all Data</p></div>
        <div class="adminHub">
        <button class="btnstyles2" type="login" onclick="toggleMusers()">Manage Users</button>
		<br>
		<br>
        <button class="btnstyles2" type="login" onclick="toggleMuserdata()">Manage User Data</button>
		<br>
        <button class="btnstyles2" type="login" onclick="toggleMhealthdata()">Manage Health Data</button>
		<br>
        <button class="btnstyles2" type="login" onclick="toggleMexercise()">Manage Exercises</button>
		<br>
        <button class="btnstyles2" type="login" onclick="toggleMreminders()">Manage Reminders</button>
	
		</div>
		
        
        <div class="form" id="manageuser" style="display: none;">
		
            <?php 
                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr> 
                    <td>USER ID</td>
                    <td>Username</td>
                    <td>Password</td>
                    <td>Admin Rights</td>
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
            <div class="b5">
			<form action="adminhub.php" name="update_user" method="POST" id="myForm">
                <div class="form-group1">
				Please enter a User ID to manage: <input type="text" name="mUserID"> <br>
				</div>
				<div class="form-group1">
                Input New Username: <input type="text" name="mUsername"> <br>
				</div>
				<div class="form-group1">
                Input New Password: <input type="text" name="mPassword"> <br>
				</div>
				<div class="form-group1">
                Select Admin Rights: <input type="text" name="mAdmin" > <br>
				</div>
				<br>
                <input class="btnstyle3" type="submit" name="update_user" value="Update Details">
            </form>
			</div>
			
        </div>
        <div class="form" id="manageuserdata" style="display: none;">
            <?php 
                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr>
                    <td>USER ID</td>
                    <td>First Names</td>
                    <td>Surname</td>
                    <td>Date of Birth</td>
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
			<div class="b5">
            <form action="adminhub.php" name="update_user_details" method="POST">
			
				<div class="form-group1">
                User ID: <input type="text" name="dUserID"> <br>
				</div>
				<div class="form-group1">
                First Names: <input type="text" name="dFirstNames"> <br>
				</div>
				<div class="form-group1">
                Surname: <input type="text" name="dSurname"> <br>
				</div>
				<div class="form-group1">
                Date of Birth: <input type="date" name="dDOB"> <br>
				</div>
				<br>
                <input class="btnstyle3"type="submit" name="update_user_details" value="Update Details">
				</div>
            </form>
        </div>
        <div class="form" id="managehealthdata" style="display: none;">
            <?php 
                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr>
                    <td>USER ID</td>
                    <td>Checkin ID</td>
                    <td>Timestamp</td>
                    <td>Heart Rate</td>
                    <td>Body Temp</td>
                    <td>Blood Pressure</td>
                    <td>Blood Oxygen</td>
                    <td>Breathing Rate</td>
                    <td>ECG Details</td>
                    </tr>';
                
                foreach($health_data as $row){

                    $huserid = $row["user_id"];
                    $checkin_id = $row["checkin_id"];
                    $htimestamp = $row["timestamp"];
                    $hheartrate = $row["heartrate"];
                    $hhbodtemp = $row["bodtemp"];
                    $hblpressure = $row["blpressure"];
                    $hbloxygen = $row["bloxygen"];
                    $hbreathrate = $row["breathrate"];
                    $hecgdet = $row["ecgdet"];

                    echo '<tr>
                        <td>'.$huserid.'</td>
                        <td>'.$checkin_id.'</td>
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
			<div class="b5">
            Enter the details to modify below:

            <form action="adminhub.php" name="update_physio" method="POST">
			<div class="form-group1">
                Checkin ID: <input type="text" name="pCheckinID"> <br>
				</div>
				<div class="form-group1">
                Heartbeat/Pulse rate: <input type="text" name="pHeartrate"> <br>
				</div>
				<div class="form-group1">
                Body Temperature: <input type="text" name="pBodtemp"> <br>
				</div>
				<div class="form-group1">
                Blood Pressure: <input type="text" name="pBlpressure"> <br>
				</div>
				<div class="form-group1">
                Blood Oxygen: <input type="text" name="pBloxygen"> <br>
				</div>
				<div class="form-group1">
                Breathing/Respiration Rate: <input type="text" name="pBreathrate"> <br>
				</div>
				<div class="form-group1">
                ECG Details: <input type="text" name="pEcgdet"> <br>
				</div>
				<br>
                <input class= "btnstyle3" type="submit" name="update_physio" value="Update Details">
            </form>
        </div>
		</div>
        <div class="form" id="manageexercise" style="display: none;">
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
            <br>
			<div class="b3">
            Please enter the Exercise Details to modify below
            <form action="adminhub.php" name="update_exercise" method="POST">
			
				<div class="form-group1">
                Exercise ID: <input type = "text" name="eID"> <br>
				</div>
				<div class="form-group1">
                Exercise Name: <input type="text" name="eName"> <br>
				</div>
				<div class="form-group1">
                Exercise Duration: <input type="text" name="eTime"> <br>
				</div>
				<div class="form-group1">
                Exercise Notes: <input type="text" name="eNotes"> <br>
				</div>
				<br>
                <input class="btnstyle3" type="submit" name="update_exercise" value="Save Exercise Details">
            </form>
        </div>
		</div>
        <div class="form" id="managereminders" style="display: none;">
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
            <br>
            Please enter the date of your reminder/appointment followed by the details
            <div class="b5">
            <form action="adminhub.php" name="update_appointment" method="POST">
			
				<div class="form-group1">
                Reminder ID: <input type="text" name="rID"> <br>
				</div>
				<div class="form-group1">
                Date of Reminder/Appointment: <input type="date" name="rDate"> <br>
				</div>
				<div class="form-group1">
                Time of Reminder/Appointment: <input type="time" name="rTime"> <br>
				</div>
				<div class="form-group1">
                Reminder Details: <input type="text" name="rDetails"> <br>
				</div>
				</br>
                <input class="btnstyle3" type="submit" name="update_appointment" value="Save Reminder/Appointment">
            </form>
			</div>
        </div>
    </body>
    <script src="toggledisplay.js"></script>
</html>

<?php
    $server = "localhost";
    $username = "root" ;
    $password = "";
    $dbname = "health_app";

    $conn = new mysqli($server , $username , $password , $dbname);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $timestamp = date('Y-m-d H:i:s');
        if(!empty($_POST['update_user'])){
            if(!empty($_POST['mUserID'])){
                $mUserID = $_POST['mUserID'];

                if(!empty($_POST['mUsername'])){
                    $mUsername = $_POST['mUsername'];
                    $updatequery = "UPDATE users SET username = '$mUsername' where id = $mUserID;";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['mPassword'])){
                    $mPassword = password_hash($_POST['mPassword'], PASSWORD_DEFAULT);
                    $updatequery = "UPDATE users SET password = '$mPassword' where id = $mUserID;";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['mAdmin'])){
                    $mAdmin = $_POST['mAdmin'];
                    $updatequery = "UPDATE users SET admin = '$mAdmin' where id = $mUserID;";
                    mysqli_query($conn, $updatequery);
                }
            } else {
                echo "<script>alert('Please enter a User ID');</script>";
            }
        }
        if(!empty($_POST['update_user_details'])){
            if(!empty($_POST['dUserID'])){
                $dUserID = $_POST['dUserID'];

                if(!empty($_POST['dFirstNames'])){
                    $dFirstNames = $_POST['dFirstNames'];
                    $updatequery = "UPDATE user_details SET first_names = '$dFirstNames' where user_id = $dUserID;";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['dSurname'])){
                    $dSurname = $_POST['dSurname'];
                    $updatequery = "UPDATE user_details SET surname = '$dSurname' where user_id = $dUserID;";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['dDOB'])){
                    $dDOB = $_POST['dDOB'];
                    $updatequery = "UPDATE user_details SET date_of_birth = '$dDOB' where user_id = $dUserID;";
                    mysqli_query($conn, $updatequery);
                }
            } else {
                echo "<script>alert('Please enter a User ID');</script>";
            }
        }
        if(!empty($_POST['update_physio'])){
            if(!empty($_POST['pCheckinID'])){
                $pCheckinID = $_POST['pCheckinID'];
                if(!empty($_POST['pBodtemp'])){
                    $bodtemp = $_POST['pBodtemp'];
                    $updatequery = "UPDATE health_data SET bodtemp = '$bodtemp' where checkin_id = $pCheckinID;";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['pHeartrate'])){
                    $heartrate = $_POST['pHeartrate'];
                    $updatequery = "UPDATE health_data SET heartrate = '$heartrate' where checkin_id = $pCheckinID;";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['pBlpressure'])){
                    $blpressure = $_POST['pBlpressure'];
                    $updatequery = "UPDATE health_data SET blpressure = '$blpressure' where checkin_id = $pCheckinID;";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['pBloxygen'])){
                    $bloxygen = $_POST['pBloxygen'];
                    $updatequery = "UPDATE health_data SET bloxygen = '$bloxygen' where checkin_id = $pCheckinID;";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['pBreathrate'])){
                    $breathrate = $_POST['pBreathrate'];
                    $updatequery = "UPDATE health_data SET breathrate = '$breathrate' where checkin_id = $pCheckinID;";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['pEcgdet'])){
                    $ecgdet = $_POST['pEcgdet'];
                    $updatequery = "UPDATE health_data SET ecgdet = '$ecgdet' where checkin_id = $pCheckinID;";
                    mysqli_query($conn, $updatequery);
                }
            } else {
                echo "<script>alert('Please enter a Checkin ID');</script>";
            }
        }
        if(!empty($_POST['update_exercise'])){
            if(!empty($_POST['eID'])){
                $eID = $_POST['eID'];
                if(!empty($_POST['eName'])){
                    $eName = $_POST['eName'];
                    $updatequery = "UPDATE exercise_data SET ename = '$eName' where exercise_id = $eID";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['eTime'])){
                    $eTime = $_POST['eTime'];
                    $updatequery = "UPDATE exercise_data SET etime = '$eTime' where exercise_id = $eID";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['eNotes'])){
                    $eNotes = $_POST['eNotes'];
                    $updatequery = "UPDATE exercise_data SET enotes = '$eNotes' where exercise_id = $eID";
                    mysqli_query($conn, $updatequery);
                }
            } else {
                echo  "<script>alert('Please enter an Exercise ID');</script>";
            }
        }
        if(!empty($_POST['update_appointment'])){
            if(!empty($_POST['rID'])){
                $rID = $_POST['rID'];
                if(!empty($_POST['rDate']) && !empty($_POST['rTime'])){
                    $rDate = new DateTime($_POST['rDate']);
                    $rTime = new DateTime($_POST['rTime']);
                    $rDate->setTime($rTime->format('H'), $rTime->format('i'), $rTime->format('s'));
                    $datetime = $rDate->format('Y-m-d H:i:s');

                    $updatequery = "UPDATE reminders SET reminderdate = '$datetime' where reminder_id = $rID";
                    mysqli_query($conn, $updatequery);
                }
                if(!empty($_POST['rDetails'])){
                    $rDetails = $_POST['rDetails'];
                    $updatequery = "UPDATE reminders SET reminderdetails = '$rDetails' where reminder_id = $rID";
                    mysqli_query($conn, $updatequery);
                }
            } else {
                echo "<script>alert('Please enter a Reminder ID');</script>";
            }
        }
        $conn->close();
        
        echo '<script>window.location.assign("adminhub.php");</script>';
    }
?>