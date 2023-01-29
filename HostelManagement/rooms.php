<?php
session_start();
include('connect.php');
include('checklogin.php');
check_login();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from rooms where id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Data Deleted');</script>" ;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main-Page</title>
    <!-- <link rel="stylesheet" href="main_page.css"> -->
    <script src="https://kit.fontawesome.com/e2f7be78fd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=EB+Garamond&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="rooms.css">
    <title>Room Details</title>
</head>

<body>
<?php include('header.php')?>    
    <div class="rooms">
        <h1>MANAGE ROOMS</h1>
        <table>
            <tr>
                <th>Sr_No.</th>
                <th>Seater</th>
                <th>Room no.</th>
                <th>Fees</th>
                <th>AC/Non-AC</th>
                <th>Action</th>
            </tr>
            <?php
            $aid = $_SESSION['id'];
            $sql = "select * from rooms";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute(); 
            $res = $stmt->get_result();
            //$stmt->bind_param('i',$aid);
            $cnt=1;
                while($row = $res->fetch_object()){
                    ?>
                    <tr>
                    <td><?php echo $cnt;?></td>
                    <td><?php echo $row->seater; ?></td>
                    <td><?php echo $row->room_no; ?></td>
                    <td><?php echo $row->fees; ?></td>
                    <td><?php echo $row->AC; ?></td>
                    <td><a href="edit_room.php?id=<?php echo $row->id; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="rooms.php?del=<?php echo $row->id; ?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a>
                    </td>
                </tr>
                    <?php
                    $cnt=$cnt+1;
                }
         ?>


        </table>
    </div>

    <!-- <p>&larr; Drag window (in editor or full page view) to see the effect. &rarr;</p> -->
</body>
<footer class="w3-center w3-black w3-padding-16">
    <p>Web Technology Project</p>
</footer>

</html>