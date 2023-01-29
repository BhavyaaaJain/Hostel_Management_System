<?php
session_start();
include('connect.php');
include('checklogin.php');
check_login();
if (isset($_POST['submit'])) {
    $seater = $_POST['seater'];
    $fees = $_POST['fees'];
    $id = $_GET['id'];
    $query = "update rooms set seater=?,fees=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('iii', $seater, $fees, $id);
    $stmt->execute();
    echo "<script>alert('Room Details has been Updated successfully');</script>";
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
        <h1>EDIT ROOM DETAILS</h1>
        <p style="color: rgb(156 170 188);"> _____________________________________________________________________________________________________________________________________________________________</p>
        <div class="form">
            <form method="post">
            <?php	
												$id=$_GET['id'];
	$ret="select * from rooms where id=?";
		$stmt= $mysqli->prepare($ret) ;
	 $stmt->bind_param('i',$id);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
	  {
	  	?>
                <div class="seater">
                    <p>Select Seater</p>
                    <input type="number" name="seater" value="<?php echo $row->seater;?>" id="seater">
                </div>
                <div class="roomno">
                    <p>Room No.</p>
                    <input type="text" name="number" value="<?php echo $row->room_no;?>" id="number" disabled>
                    <span style="font-size: 15px; color:red">(Room no can't be changed.)</span>
                </div>

                <div class="fees">
                    <p>Fee(Per Head)</p>
                    <input type="number" name="fees" id="fees"  value="<?php echo $row->fees;?>">
                </div>
                <?php } ?>
                <div class="sbmt">
                    <input type="submit" name="submit" id="submit">
                </div>

            </form>

        </div>
    </div>
</body>
<footer class="w3-center w3-black w3-padding-16">
    <p>Web Technology Project</p>
</footer>

</html>