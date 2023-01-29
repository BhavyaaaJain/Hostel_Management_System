<?php
session_start();
include('connect.php');
include('checklogin.php');
check_login();
if (isset($_POST['update'])) {
    $email = $_POST['emailid'];
    $aid = $_SESSION['id'];
    $query = "update admin set email=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('si', $email, $aid);
    $stmt->execute();
    echo "<script>alert('Email id has been successfully updated');</script>";
}

if (isset($_POST['changepwd'])) {
    $op = $_POST['oldpassword'];
    $np = $_POST['newpassword'];
    $ai = $_SESSION['id'];
    $sql = "SELECT password FROM admin where password=?";
    $chngpwd = $mysqli->prepare($sql);
    $chngpwd->bind_param('s', $op);
    $chngpwd->execute();
    $chngpwd->store_result();
    $row_cnt = $chngpwd->num_rows;;
    if ($row_cnt > 0) {
        $con = "update admin set password=?  where id=?";
        $chngpwd1 = $mysqli->prepare($con);
        $chngpwd1->bind_param('si', $np, $ai);
        $chngpwd1->execute();
        $_SESSION['msg'] = "Password Changed Successfully !!";
    } else {
        $_SESSION['msg'] = "Old Password not match !!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <script src="https://kit.fontawesome.com/e2f7be78fd.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=EB+Garamond&display=swap" rel="stylesheet">
    <title>Document</title>
    <script>
        function valid() {

            if (document.changepwd.newpassword.value != document.changepwd.cpassword.value) {
                alert("Password and Re-Type Password Field do not match  !!");
                document.changepwd.cpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <?php include('header.php') ?>
    <h1>ADMIN PROFILE</h1>
    <?php
    $aid = $_SESSION['id'];
    $ret = "select * from admin where id=?";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param('i', $aid);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    //$cnt=1;
    while ($row = $res->fetch_object()) {
    ?>
        <div class="adm">
            <div id="details" class="inbox">
                <form method="post" >
                    <div class="name">
                        <p>Username</p>
                        <!-- <label>Username</label> -->
                        <input type="text" name="uname" value="<?php echo $row->username; ?>" style="color: white;">
                    </div>
                    <div class="mail">
                        <p>E-mail</p>
                        <!-- <label>Email</label> -->
                        <input type="email" name="emailid" value="<?php echo $row->email; ?>" style="color: white;">
                    </div>
                    
                    <div class="submt">
                        <input type="submit" name="update" value="Update Details"></button>
                    </div>

                </form>
            <?php }  ?>
            </div>
            <div id="changepwd" class="inbox">
                <form action="" method="post" onSubmit="return valid();">
                    <?php if (isset($_POST['changepwd'])) { ?>
                        <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                    <?php } ?>
                    <div class="opwd">
                        <!-- <label>Old Password</label> -->
                        <p>Old Password</p>
                        <input type="password" name="oldpassword" onBlur="checkpass()" style="color: white;" required>
                    </div>
                    <div class="npwd">
                        <!-- <label>New Password</label> -->
                        <p>New Password</p>
                        <input type="password" name="newpassword" id="" style="color: white;" required>
                    </div>
                    <div class="cpwd">
                        <!-- <label>Confirm Password</label> -->
                        <p>Confirm Password</p>
                        <input type="password" name="cpassword" id="" style="color: white;" required>
                    </div>
                    <div class="submt">
                        <input type="submit" name="changepwd" style="color: white;" value="Update Password"></button>
                    </div>

                </form>

            </div>
        </div>
</body>
<footer class="w3-center w3-black w3-padding-16">
    <p>Web Technology Project</p>
</footer>

</html>