<?php
include("conn.php");
include("sessionverifier.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Elderly Home's Club</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/staffinfo_userverification2.css" rel="stylesheet">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php 
include ("header.php"); 
$sql="SELECT * FROM user WHERE user_id = '$_GET[id]';";
$result = mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
if ($row["user_pp"] == ""){
	if ($row ["user_gender"] == 'male'){
		$ppSource = 'img/5e5356897371bb93979e09cd_peep-42.png';
	} else if ($row ["user_gender"] == 'female'){
		$ppSource = 'img/5e535d897488c25a204b12ff_peep-102.png';
	}
} else {
	$ppSource = "uploads/" . $row["user_pp"];
}
$info_box2='

<div class="w-100 d-flex flex-column flex-nowrap">
	<div class=" w-100 text-center fw-bold verification2_h1"> User Verification </div>
    <div class="d-flex justify-content-center pt-3"> <img class="verification_idimg" src="uploads/'.$row["verification_ic"].'" alt="useridcard" id="useridcard"> </div>
    <div class="w-100 header_bold h6 pt-2 text-decoration-underline">USER IDENTIFICATION CARD</div>
    <div class="pt-2 pb-3"> 
        <form class="w-100 d-flex justify-content-center" method="post" name="user_verification" >
        <input class="verification_btn" name="user_verificationaccept" type="submit" value="Accept">
        <input class="verification_btn" name="user_verificationdecline" type="submit" value="Decline">
        </form>
    </div>
    <div class="d-flex justify-content-start verification_padding verification2_p"> 
        <img class="verification_userimg" src="'.$ppSource.'" alt="useridcard" id="useridcard"> 
        <div class="d-flex verification_userinfo"> Name : '.$row ["user_fname"].'&nbsp;'.$row["user_lname"].' <br> <br> ID : '.$row["user_id"].' <br> <br> Verification Status : '.$row ["verification_status"].'</div>
    </div>
</div>';
echo $info_box2;
include ("footer.php");
?>
<?php
if (isset($_POST['user_verificationaccept'])) {

	$sql="UPDATE user SET verification_status = 'verified' WHERE user_id = '$_GET[id]'";
	if (!mysqli_query($con,$sql)){
			die('Error: ' . mysqli_error($con));
		}
	else {
		echo "<script>
		window.location.href= 'staffinfo_userverification.php';
		</script>";
	}
	mysqli_close($con);}
elseif (isset($_POST['user_verificationdecline'])){

	$sql="UPDATE user SET verification_status = 'unverified', verification_ic = NULL WHERE user_id = '$_GET[id]'";
	if (!mysqli_query($con,$sql)){
			die('Error: ' . mysqli_error($con));
		}
	else {
		echo "<script>
		window.location.href= 'staffinfo_userverification.php';
		</script>";
	}
	mysqli_close($con);}
?>
</body>
</html>
