<?php
session_start();
include('connect.php');
include('checklogin.php');
check_login();
if (isset($_POST['submit'])) {
    $seater = $_POST['seater'];
    $roomno = $_POST['rmno'];
    $fees = $_POST['fee'];
    $Ac = $_POST['AC'];
    $sql = "SELECT room_no FROM rooms where room_no=?";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('i', $roomno);
    $stmt1->execute();
    $stmt1->store_result();
    $row_cnt = $stmt1->num_rows;;
    if ($row_cnt > 0) {
        echo "<script>alert('Room alreadt exist');</script>";
    } else {
        $query = "insert into  rooms (seater,room_no,fees,Ac) values(?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('iiis', $seater, $roomno, $fees, $Ac);
        $stmt->execute();
        echo "<script>alert('Room has been added successfully');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e2f7be78fd.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=EB+Garamond&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="add_room.css">
    <title>Document</title>
</head>

<body>
    <?php include('header.php') ?>
    <div class="addroom">
        <h1>ADD A ROOM</h1>
        <p style="color: rgb(156 170 188);"> _____________________________________________________________________________________________________________________________________________________________</p>
        <form method="post">
        <div class="form">
            <div class="seater">
                <p>Select Seater</p>
                <Select name="seater" class="form-control" style="color:black; margin:10px; padding:3px; " required>
                    <option value="1">Single Seater</option>
                    <option value="2">Two Seater</option>
                    <option value="3">Three Seater</option>
                    <option value="4">Four Seater</option>
                    <option value="5">Five Seater</option>
                </Select>
            </div>
            <div class="roomno">
                <p>Room No.</p>
                <input type="number" name="rmno" id="number">
            </div>

            <div class="fees">
                <p>Fee(Per Head)</p>
                <input type="number" name="fee" id="fee">
            </div>
            <div class="fees">
                <p>AC or Non-AC</p>
                <Select name="AC" class="form-control" style="color:black; margin:10px; padding:3px; " required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </Select>
            </div>
            <div class="sbmt">
                <input type="submit" name="submit" id="submit">
            </div>
        </div>
        </form>
    </div>
</body>
<footer class="w3-center w3-black w3-padding-16">
    <p>Web Technology Project</p>
</footer>

</html>