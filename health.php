<!DOCTYPE html>
<html lang="en">
    <head>
        <?php session_start();
        if(!$_SESSION['user']) {
            header("location: index.php");
        }
        $user = $_SESSION['user']; ?>
        <link href="default.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            #addhata {
                width: 100%;
                padding: 50px 0;
                text-align: left;
                background-color: #ccffff;
                margin-top: 20px;
            }
            #addexcercise {
                width: 100%;
                padding: 50px 0;
                text-align: left;
                background-color: #ccffff;
                margin-top: 20px;
            }
            #addreminder {
                width: 100%;
                padding: 50px 0;
                text-align: left;
                background-color: #ccffff;
                margin-top: 20px;
            }
        </style>
        <title>A3 Health - Manage Personal Data</title>
    </head>
    <body>
        <?php include 'header.php'?>
        <p>Manage Your Personal Health Data</p>
        
        <button onclick="toggledisphdata()">Log Physiological Data</button>
        <button onclick="toggleexcercise()">Log Excercise Data</button>
        <button onclick="togglereminder()">Log Reminder/Appointment</button>
        

        <div id="addhdata">
            Please enter your Physiological Data Below <br>
            <form action="health.php" method="POST">
                Heartbeat/Pulse rate: <input type="text" name="heartrate" > <br>
                Body Temperature: <input type="text" name="bodtemp"> <br>
                Blood Pressure: <input type="text" name="blpressure"> <br>
                Blood Oxygen: <input type="text" name="bloxygen" > <br>
                Breathing/Respiration Rate: <input type="text" name="breathrate" > <br>
                ECG Details: <input type="text" name="ecgdet" > <br>
                <input type="submit" value="Save Physiological Data">
            </form>
        </div>

        <div id="addexcercise">
        Please enter your Exercise Details Below
            <form action="health.php" method="POST">
                Exercise Name: <input type="text" name="ename" > <br>
                Exercise Duration: <input type="text" name="etime"> <br>
                Exercise Notes: <input type="text" name="enotes"> <br>
                <input type="submit" value="Save Excercise Details">
            </form>
        </div>

        <div id="addreminder">
        Please enter the date of your reminder/appointment followed by the details

            <form action="health.php" method="POST">
                Date of Reminder/Appointment: <input type="text" name="reminderdate" > <br>
                Reminder Details: <input type="text" name="reminderdetails"> <br>
                <input type="submit" value="Save Reminder/Appointment">
            </form>
        </div>

        <script>
            function toggledisphdata() {
                var x = document.getElementById("addhdata");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
            function toggleexcercise() {
                var x = document.getElementById("addexcercise");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
            function togglereminder() {
                var x = document.getElementById("addreminder");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
    </body>
</html>

<?php
    $server = "localhost";
    $username = "root" ;
    $password = "";
    $dbname = "health_app";

    $conn = mysqli_connect($server , $username , $password , $dbname);

    if(isset($_POST['submit'])){
        if(!empty($_POST['bodtemp']) && !empty($_POST['blpressure']) && !empty($_POST['bloxygen']) && !empty($_POST['breathrate']) && !empty($_POST['ecgdet'])){
            
            $bodtemp = $_POST['bodtemp'];
            $blpressure = $_POST['blpressure'];
            $bloxygen = $_POST['bloxygen'];
            $breathrate = $_POST['breathrate'];
            $ecgdet = $_POST['ecgdet'];
            
            $query = "insert into health_data(bodtemp, blpressure, bloxygen, breathrate, ecgdet) values ('$bodtemp', '$blpressure', '$bloxygen', '$breathrate', '$ecgdet')" ;
            $run = mysqli_query($conn, $query) or die(mysqli_error());
            
            if ($run){
                
                echo "Health Data Submitted Successfully";
                
            } else {
                
                echo "Health Data Not Submitted, Please recheck and try again";
            }
            
            
        }
        else {
            echo "all fields required";
        }
    }
?>