<?php
session_start();
include('connect.php');

// check if the user is already logged in
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT username,email,password,id FROM admin WHERE (userName=?|| email=?) and password=? ");
    $stmt->bind_param('sss', $username, $username, $password);
    $stmt->execute();
    $stmt->bind_result($username, $username, $password, $id);
    $rs = $stmt->fetch();
    $_SESSION['id'] = $id;
    $uip = $_SERVER['REMOTE_ADDR'];
    $ldate = date('d/m/Y h:i:s', time());
    if ($rs) {
        //  $insert="INSERT into admin(adminid,ip)VALUES(?,?)";
        // $stmtins = $mysqli->prepare($insert);
        // $stmtins->bind_param('sH',$id,$uip);
        //$res=$stmtins->execute();
        header("location:main_page.php");
    } else {
        echo "<script>alert('Invalid Username/Email or password');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/e2f7be78fd.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=EB+Garamond&display=swap" rel="stylesheet">
</head>

<body>

    <div class="outer">
        <div class="login">
            <form action="" method="post" id="formdiv">
                <h1 style="color:rgb(156 170 188); ">HOSTEL MANAGEMENT SYSTEM</h1>
                <div class="imgdiv">
                    <i class="fa-regular fa-user"></i>
                </div>
                <h2>LOGIN</h2> <br>
                <div class="username">
                    <label>USERNAME:</label>
                    <input type="text" name="username" id="username"> <br>
                </div>
                <div class="password">
                    <label>PASSWORD:</label>
                    <input type="password" name="password" id="password"> <br>
                </div>
                <!-- <label>LOGIN</label> -->
                <input type="submit" name="login" value="login"> <br>
                
            </form>
        </div>
    </div>

</body>
<footer class="w3-center w3-black w3-padding-16">
    <p>Web Technology Project</p>
</footer>

</html>