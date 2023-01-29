<?php
session_start();
include('connect.php');
include('checklogin.php');
check_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Main-Page</title>
	<link rel="stylesheet" href="main_page.css">
	<script src="https://kit.fontawesome.com/e2f7be78fd.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=EB+Garamond&display=swap" rel="stylesheet">
</head>

<body>
	<?php include('header.php') ?>
	<div class="ts-main-content">
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row" id="print">


					<div class="col-md-12">
						<h2 class="page-title" style="margin:40px; color:whitesmoke;">Rooms Details</h2>
						<div class="panel panel-default" style="background-color: white;">
							<div class="panel-heading">All Room Details</div>
							<div class="panel-body">
								<table id="zctb" class="table table-bordered " cellspacing="0" width="100%" border="1">

									<span style="float:left"><i class="fa fa-print fa-2x" aria-hidden="true" OnClick="CallPrint(this.value)" style="cursor:pointer" title="Print the Report"></i></span>
									<tbody>
										<?php
										$aid = intval($_GET['regno']);
										$ret = "select * from registration where (regno	=?)";
										$stmt = $mysqli->prepare($ret);
										$stmt->bind_param('s', $aid);
										$stmt->execute();
										$res = $stmt->get_result();
										$cnt = 1;
										while ($row = $res->fetch_object()) {
										?>

											<tr>
												<td colspan="6" style="text-align:center; color:blue">
													<h3>Room Realted Info</h3>
												</td>
											</tr>
											<tr>
												<th>Registration Number :</th>
												<td><?php echo $row->regno; ?></td>
											
											</tr>



											<tr>
												<td><b>Room no :</b></td>
												<td><?php echo $row->roomno; ?></td>
												<td><b>Seater :</b></td>
												<td><?php echo $row->seater; ?></td>
												<td><b>Fees PM :</b></td>
												<td><?php echo $fpm = $row->feespm; ?></td>
											</tr>

											<tr>
												<td><b>Food Status:</b></td>
												<td>
													<?php if ($row->foodstatus == 0) {
														echo "Without Food";
													} else {
														echo "With Food";
													}; ?></td>
												<td><b>Stay From :</b></td>
												<td><?php echo $row->stayfrom; ?></td>
												<td><b>Duration:</b></td>
												<td><?php echo $dr = $row->duration; ?> Months</td>
											</tr>

											<tr>
												<th>Hostel Fee:</th>
												<td><?php echo $hf = $dr * $fpm ?></td>
												<th>Food Fee:</th>
												<td colspan="3"><?php
																if ($row->foodstatus == 1) {
																	echo $ff = (2000 * $dr);
																} else {
																	echo $ff = 0;
																	echo "<span style='padding-left:2%; color:red;'>(You booked hostel without food).<span>";
																} ?></td>
											</tr>
											<tr>
												<th>Total Fee :</th>
												<th colspan="5"><?php echo $hf + $ff; ?></th>
											</tr>
											<tr>
												<td colspan="6" style="color:red">
													<h4>Personal Info</h4>
												</td>
											</tr>

											<tr>
												<td><b>Reg No. :</b></td>
												<td><?php echo $row->regno; ?></td>
												<td><b>Full Name :</b></td>
												<td><?php echo $row->firstName; ?><?php echo $row->middleName; ?><?php echo $row->lastName; ?></td>
												<td><b>Email :</b></td>
												<td><?php echo $row->emailid; ?></td>
											</tr>


											<tr>
												<td><b>Contact No. :</b></td>
												<td><?php echo $row->contactno; ?></td>
												<td><b>Gender :</b></td>
												<td><?php echo $row->gender; ?></td>
												
											</tr>


											<tr>
												<td><b>Emergency Contact No. :</b></td>
												<td><?php echo $row->egycontactno; ?></td>
												<td><b>Guardian Name :</b></td>
												<td><?php echo $row->guardianName; ?></td>
												
											</tr>

											<tr>
												<td><b>Guardian Contact No. :</b></td>
												<td colspan="6"><?php echo $row->guardianContactno; ?></td>
											</tr>

											<tr>
												<td colspan="6" style="color:blue">
													<h4>Addresses</h4>
												</td>
											</tr>
											<tr>
												
												<td><b>Permanent Address</b></td>
												<td colspan="2">
													<?php echo $row->pmntAddress; ?><br />
													<?php echo $row->pmntCity; ?>, <?php echo $row->pmntPincode; ?><br />
													<?php echo $row->pmnatetState; ?>

												</td>
											</tr>


										<?php
											$cnt = $cnt + 1;
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script>
		$(function() {
			$("[data-toggle=tooltip]").tooltip();
		});

		function CallPrint(strid) {
			var prtContent = document.getElementById("print");
			var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
			WinPrint.document.write(prtContent.innerHTML);
			WinPrint.document.close();
			WinPrint.focus();
			WinPrint.print();
			WinPrint.close();
		}
	</script>
</body>
<footer class="w3-center w3-black w3-padding-16">
    <p>Web Technology Project</p>
</footer>

</html>