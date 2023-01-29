<?php
session_start();
include('connect.php');
include('check_login.php');
if (isset($_POST['submit'])) {
	$roomno = $_POST['room'];
	$seater = $_POST['seater'];
	$feespm = $_POST['fpm'];
	$foodstatus = $_POST['foodstatus'];
	$stayfrom = $_POST['stayf'];
	$duration = $_POST['duration'];
	$regno = $_POST['regno'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
	$contactno = $_POST['contact'];
	$emailid = $_POST['email'];
	$emcntno = $_POST['econtact'];
	$gurname = $_POST['gname'];
	$gurcntno = $_POST['gcontact'];
	$paddress = $_POST['address'];
	$pcity = $_POST['city'];
	$pstate = $_POST['state'];
	$ppincode = $_POST['pincode'];
	$result ="SELECT count(*) FROM userRegistration WHERE email=? || regNo=?";
		$stmt = $mysqli->prepare($result);
		$stmt->bind_param('ss',$email,$regno);
		$stmt->execute();
		$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
if($count>0)
{
echo"<script>alert('Registration number or email id already registered.');</script>";
}else{

	$sql = "insert into registration(roomno, seater, feespm, foodstatus, stayfrom, duration, regno, firstName, middleName, lastName, gender, contactno, emailid, egycontactno, guardianName, guardianContactno, pmntAddress, pmntCIty, pmnatetState, pmntPincode) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$stmt = $mysqli->prepare($sql);
	$rc = $stmt->bind_param('iiiisiissssisisisssi', $roomno, $seater, $feespm, $foodstatus, $stayfrom, $duration, $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $emcntno, $gurname, $gurcntno, $paddress, $pcity, $pstate, $ppincode);
	$stmt->execute();
	$stmt->close();
	echo "<script>alert('Student Succssfully register');</script>";
}}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Student Hostel Registration</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- <link rel="stylesheet" href="css/style.css"> -->
	<link rel="stylesheet" href="book_hostel.css">
	<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="js/validation.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script>
		function getSeater(val) {
			$.ajax({
				type: "POST",
				url: "get_seater.php",
				data: 'roomid=' + val,
				success: function(data) {
					//alert(data);
					$('#seater').val(data);
				}
			});

			$.ajax({
				type: "POST",
				url: "get_seater.php",
				data: 'rid=' + val,
				success: function(data) {
					//alert(data);
					$('#fpm').val(data);
				}
			});
		}
	</script>

</head>

<body>
<?php include('header.php')?>    
	<div class="hostelform">
		<div class="ts-main-content">
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<!-- <div class="col-md-12"> -->

						<h1 style="margin-bottom: 50px;">REGISTRATION </h1>

						<div class="row" style="margin: 10px;">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">Fill all Info</div>
									<div class="panel-body" style="background-color: #222D32;">
										<form method="post" action="" class="form-horizontal">


											<div class="form-group">
												<label class="col-sm-4 control-label">
													<h4 style="color:  rgb(156 170 188);" align="left">Room Related info </h4>
												</label>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Room no. </label>
												<div class="col-sm-8">
													<select name="room" id="room" class="form-control" onChange="getSeater(this.value);" onBlur="checkAvailability()" required>
														<option value="">Select Room</option>
														<?php $query = "SELECT * FROM rooms";
														$stmt2 = $mysqli->prepare($query);
														$stmt2->execute();
														$res = $stmt2->get_result();
														while ($row = $res->fetch_object()) {
														?>
															<option value="<?php echo $row->room_no; ?>"> <?php echo $row->room_no; ?></option>
														<?php } ?>
													</select>

													<span id="room-availability-status" style="font-size:12px;"></span>

												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Seater</label>
												<div class="col-sm-8">
													<input type="int" name="seater" id="seater" class="form-control">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Fees Per Month</label>
												<div class="col-sm-8">
													<input type="int" name="fpm" id="fpm" class="form-control">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Food Status</label>
												<div class="col-sm-8">
													<input type="radio" value="0" name="foodstatus" checked="checked">
													Without Food
													<input type="radio" value="1" name="foodstatus"> With Food(Rs
													2000.00 Per Month Extra)
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Stay From</label>
												<div class="col-sm-8">
													<input type="date" name="stayf" id="stayf" class="form-control">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Duration</label>
												<div class="col-sm-8">
													<select name="duration" id="duration" class="form-control">
														<option value="">Select Duration in Month</option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
													</select>
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">
													<h4 style="color:  rgb(156 170 188);" align="left">Personal info </h4>
												</label>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Registration No : </label>
												<div class="col-sm-8">
													<input type="int" name="regno" id="regno" class="form-control" required="required">
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">First Name : </label>
												<div class="col-sm-8">
													<input type="text" name="fname" id="fname" class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Middle Name : </label>
												<div class="col-sm-8">
													<input type="text" name="mname" id="mname" class="form-control">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Last Name : </label>
												<div class="col-sm-8">
													<input type="text" name="lname" id="lname" class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Gender : </label>
												<div class="col-sm-8">
													<select name="gender" class="form-control" required="required">
														<option value="">Select Gender</option>
														<option value="male">Male</option>
														<option value="female">Female</option>
														<option value="others">Others</option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Contact No : </label>
												<div class="col-sm-8">
													<input type="int" name="contact" id="contact" class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Email id : </label>
												<div class="col-sm-8">
													<input type="email" name="email" id="email" class="form-control">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Emergency Contact: </label>
												<div class="col-sm-8">
													<input type="int" name="econtact" id="econtact" class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Guardian Name : </label>
												<div class="col-sm-8">
													<input type="text" name="gname" id="gname" class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Guardian Contact no : </label>
												<div class="col-sm-8">
													<input type="int" name="gcontact" id="gcontact" class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">
													<h4 style="color:  rgb(156 170 188);" align="left">Address </h4>
												</label>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">Address : </label>
												<div class="col-sm-8">
													<textarea rows="5" name="address" id="address" class="form-control" required="required"></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">City : </label>
												<div class="col-sm-8">
													<input type="text" name="city" id="city" class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">State </label>
												<div class="col-sm-8">
													<select name="state" id="state" class="form-control" required>
														<option value="">Select State</option>
														<?php $query = "SELECT * FROM states";
														$stmt2 = $mysqli->prepare($query);
														$stmt2->execute();
														$res = $stmt2->get_result();
														while ($row = $res->fetch_object()) {
														?>
															<option value="<?php echo $row->State; ?>"><?php echo $row->State; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Pincode : </label>
												<div class="col-sm-8">
													<input type="int" name="pincode" id="pincode" class="form-control" required="required">
												</div>
											</div>

											<div class="col-sm-6 col-sm-offset-4">
												<button class="btn btn-default"><a href="main_page.php">Cancel</a></button>
												<input type="submit" name="submit" Value="Register" class="btn btn-primary">
											</div>
										</form>

									</div>
								</div>
							</div>
						</div>
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	
</body>
<footer class="w3-center w3-black w3-padding-16">
    <p>Web Technology Project</p>
</footer>

<script type="text/javascript">
	$(document).ready(function() {
		$('input[type="checkbox"]').click(function() {
			if ($(this).prop("checked") == true) {
				$('#paddress').val($('#address').val());
				$('#pcity').val($('#city').val());
				$('#pstate').val($('#state').val());
				$('#ppincode').val($('#pincode').val());
			}

		});
	});
</script>
<script>
	function checkAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data: 'roomno=' + $("#room").val(),
			type: "POST",
			success: function(data) {
				$("#room-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>

</html>