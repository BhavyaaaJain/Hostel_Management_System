<?php
require_once "connect.php";

$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT * FROM users WHERE Name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);

    //Check for email
    if (empty(trim($_POST['email']))) {
        $email_err = "Email cannot be blank";
    } elseif (strlen(trim($_POST['email'])) < 5) {
        $email = "Email cannot be less than 5 characters";
    } else {
        $email = trim($_POST['email']);
    }

    // Check for password
    if (empty(trim($_POST['pwd1']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['pwd1'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['pwd1']);
    }

    // Check for confirm password field
    if (trim($_POST['pwd1']) !=  trim($_POST['pwd2'])) {
        $password_err = "Passwords should match";
    }

    // If there were no errors, go ahead and insert into the database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (Name, Password, Email ) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password,$param_email);

            // Set these parameters
            $param_username = $username;
            $param_password = $password;
            $param_email = $email;
            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
    <script src="https://kit.fontawesome.com/e2f7be78fd.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=EB+Garamond&display=swap" rel="stylesheet">
</head>

<body>
    <div class="register">
        <div class="imgdiv">
            <i class="fa-solid fa-user"></i>
        </div>
        <h2>REGISTER</h2>
        <form action="" method="post">
            <div class="email">
                <label>E-MAIL:</label>
                <input type="email" name="email" id="email"> <br>
            </div>

            <div class="username">
                <label>CREATE USERNAME:</label>
                <input type="text" name="username" id="username"> <br>
            </div>

            <div class="password">
                <label>PASSWORD:</label>
                <input type="Password" name="pwd1" id="pwd1"> <br>
            </div>

            <div class="confpassword">
                <label>CONFIRM PASSWORD:</label>
                <input type="Password" name="pwd2" id="pwd2"> <br>
            </div>
            <input type="submit" name="submit" id="submit" value="REGISTER">
            <div class="regbtn">
                <p>Already have an account ? <button type="button" class="reg">Register</button></p>
            </div>
        </form>

    </div>

</body>

</html>