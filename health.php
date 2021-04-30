<!DOCTYPE html>
<html lang="en">
    <head>
        <?php session_start();
        if(!$_SESSION['user']) {
            header("location: index.php");
        }
        $user = $_SESSION['user'];
        $user_id = $_SESSION['user_id']; ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>A3 Health - Manage Personal Data</title>
        <link href="default.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php'?>
        <div class="o"><p>Manage Your Personal Health Data</p></div>
        <div class="adminHub">
        <button class="btnstyles2" onclick="toggledisphdata()">Log Physiological Data</button>
        <button class="btnstyles2" onclick="toggleexercise()">Log Exercise Data</button>
        <button class="btnstyles2" onclick="togglereminder()">Log Reminder/Appointment</button>
        </div>

		
        <div class="form" id="addhdata" style="display:none;">
		<div class="b5">
            Please enter your Physiological Data below <br>
            <form action="health.php" name="physio" method="POST">
			
				<div class="form-group1">
                Heartbeat/Pulse rate: <input type="text" name="heartrate" > <br>
				</div>
				<div class="form-group1">
                Body Temperature: <input type="text" name="bodtemp"> <br>
				</div>
				<div class="form-group1">
                Blood Pressure: <input type="text" name="blpressure"> <br>
				</div>
				<div class="form-group1">
                Blood Oxygen: <input type="text" name="bloxygen" > <br>
				</div>
				<div class="form-group1">
                Breathing/Respiration Rate: <input type="text" name="breathrate" > <br>
				</div>
				<div class="form-group1">
                ECG Details: <input type="text" name="ecgdet" > <br>
				</div>
				<br>
                <input class="btnstyles2" type="submit" name="physio" value="Save Physiological Data">
            </form>
			</div>
        </div>
		

        <div class="form" id="addexercise" style="display:none;">
		<div class="b5">
        Please enter your Exercise Details below
            <form action="health.php" name="exercise" method="POST">
			
				<div class="form-group1">
                Exercise Name: <input type="text" name="ename" > <br>
				</div>
				<div class="form-group1">
                Exercise Duration: <input type="text" name="etime"> <br>
				</div>
				<div class="form-group1">
                Exercise Notes: <input type="text" name="enotes"> <br>
				</div>
				<br>
                <input class="btnstyles2" type="submit" name="exercise" value="Save Exercise Details">
            </form>
			</div>
        </div>

        <div class= "form" id="addreminder" style="display:none;">
		<div class="b5">
        Please enter the date of your reminder/appointment followed by the details

            <form action="health.php" name="appointment" method="POST">
			
				<div class="form-group1">
                Date of Reminder/Appointment: <input type="date" name="reminderdate"> <br>
				</div>
				<div class="form-group1">
                Time of Reminder/Appointment: <input type="time" name="remindertime"> <br>
				</div>
				<div class="form-group1">
                Reminder Details: <input type="text" name="reminderdetails"> <br>
				</div>
				<br>
                <input class="btnstyles2" type="submit" name="appointment" value="Save Reminder/Appointment">
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
        if(isset($_POST['physio'])){
            if(!empty($_POST['bodtemp']) && !empty($_POST['heartrate']) && !empty($_POST['blpressure']) && !empty($_POST['bloxygen']) && !empty($_POST['breathrate']) && !empty($_POST['ecgdet'])){
                
                $heartrate = $_POST['heartrate'];
                $bodtemp = $_POST['bodtemp'];
                $blpressure = $_POST['blpressure'];
                $bloxygen = $_POST['bloxygen'];
                $breathrate = $_POST['breathrate'];
                $ecgdet = $_POST['ecgdet'];
                
                $query = "INSERT INTO health_data(user_id, timestamp, heartrate, bodtemp, blpressure, bloxygen, breathrate, ecgdet) VALUES ('$user_id', '$timestamp', '$heartrate', '$bodtemp', '$blpressure', '$bloxygen', '$breathrate', '$ecgdet')" ;
                
            } else {
                echo "all fields required";
            }
        } else if(isset($_POST['exercise'])){
            if(!empty($_POST['ename']) && !empty($_POST['etime']) && !empty($_POST['enotes'])){
                $ename = $_POST['ename'];
                $etime = $_POST['etime'];
                $enotes = $_POST['enotes'];

                $query = "INSERT INTO exercise_data(user_id, timestamp, ename, etime, enotes) VALUES ('$user_id', '$timestamp', '$ename', '$etime', '$enotes')";
            } else {
                echo "All fields required";
            }
        } else if(isset($_POST['appointment'])){
            if(!empty($_POST['reminderdate']) && !empty($_POST['reminderdetails'])){
                $reminderdate = new DateTime($_POST['reminderdate']);
                $remindertime = new DateTime($_POST['remindertime']);
                $reminderdate->setTime($remindertime->format('H'), $remindertime->format('i'), $remindertime->format('s'));
                $datetime = $reminderdate->format('Y-m-d H:i:s');
                
                $reminderdetails = $_POST['reminderdetails'];

                $query = "INSERT INTO reminders(user_id, timestamp, reminderdate, reminderdetails) VALUES ('$user_id', '$timestamp', '$datetime', '$reminderdetails')";
            } else {
                echo "All fields required";
            }
        }
        mysqli_query($conn, $query);
    }
?>