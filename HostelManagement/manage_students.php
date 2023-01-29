<?php
session_start();
include('connect.php');
include('check_login.php');
check_login();
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "delete from registration where regNo=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
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
    <title>Document</title>
</head>

<body>
    <?php include('header.php') ?>
    <div class="rooms">
        <h1>MANAGE STUDENTS</h1>
        <table>
            <tr>
                <th>Sno.</th>
                <th>Student Name</th>
                <th>Reg no.</th>
                <th>Contact No.</th>
                <th>Room No.</th>
                <th>Seater</th>
                <th>Staying From</th>
                <th>Action</th>
            </tr>
            <?php
            $aid = $_SESSION['id'];
            $ret = "select * from registration";
            $stmt = $mysqli->prepare($ret);
            //$stmt->bind_param('i',$aid);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            $cnt = 1;
            while ($row = $res->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $cnt;; ?></td>
                    <td><?php echo $row->firstName; ?><?php echo $row->middleName; ?><?php echo $row->lastName; ?></td>
                    <td><?php echo $row->regno; ?></td>
                    <td><?php echo $row->contactno; ?></td>
                    <td><?php echo $row->roomno; ?></td>
                    <td><?php echo $row->seater; ?></td>
                    <td><?php echo $row->stayfrom; ?></td>
                    <td>
                        <a href="student-details.php?regno=<?php echo $row->regno; ?>" title="View Full Details"><i class="fa fa-desktop"></i></a>&nbsp;&nbsp;
                        <a href="manage_students.php?del=<?php echo $row->regno; ?>" title="Delete Record" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a>
                    </td>
                </tr>
            <?php
                $cnt = $cnt + 1;
            } ?>



        </table>
    </div>

    <!-- <p>&larr; Drag window (in editor or full page view) to see the effect. &rarr;</p> -->
</body>
<footer class="w3-center w3-black w3-padding-16">
    <p>Web Technology Project</p>
</footer>

</body>
<footer class="w3-center w3-black w3-padding-16">
    <p>Web Technology Project</p>
</footer>

</html>