<?php
if (isset($_POST['changepassword'])) {
		include("connn.php");
        if ($_POST['password'] != $_POST['confirmpassword']){
            echo "<script> alert('Password does not match')</script>";
			$confirmpw =false;}
        else {$confirmpw =true;}
		if ($confirmpw === true){
			$sql="UPDATE login SET login_pw = '$_POST[password]' WHERE (login_email = '$_GET[email]');";
			if (!mysqli_query($con,$sql)){
				die('Error: ' . mysqli_error($con));
			}
		else {
			echo "<script>
			alert('Password Changed');
			window.location.href= 'home_pg.php';
			</script>";
		}}
            mysqli_close($con);}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Elderly Home's Club</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/header.css" rel="stylesheet">
<script src="js/passwordrecover.js"></script>
<link href="css/forgotpw.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	input[type=password]{
    width: 60%;
    display: inline-block;
    margin:1% 0 1% 0;
    padding: 1%;
    font-size:15px;
    border:double;
    border-radius:5px;
}
</style>
</head>

<body>
<?php include ("header.php");?>

<div class="w-100 d-flex">
    <div class="w-50 d-flex">
        <img src="img/forgotpwimg.jpg" alt="GONG GONG PO PO" width="100%" height="100%">
    </div>
    <div class=" w-50 d-flex flex-column forgotpw">
        <div class="w-100"><h1 class="text-decoration-underline">Change Password </h1> 
		<form method="post">
			<span id="pwvalidation" style="display: none; color: red;" >*password should not contain '</span> <br>
			<span class="fw-bold">New Password  &#160&#160&#160&#160&#160&#160:</span> <input type="password" name="password" id="password" minlength="8"  onkeyup='Nosinglequoteallowed()' required="required"> <br>
			<span id="pwvalidation2" style="display: none; color: red;" >*password should not contain '</span> <br>
			<span class="fw-bold">Confirm Password : </span> <input type="password" name="confirmpassword" id="confirmpassword" minlength="8" onkeyup='Nosinglequoteallowed()' required="required"> &#160&#160
        	<input class="forgotpw_link" name="changepassword" type="submit" value="Submit">
		</form> 
        </div> 
    </div>
</div>

<?php include ("footer.php"); ?>
</body>
</html>