<?php
include("conn.php");
include("sessionverifier.php");
if (isset($_POST['userverification'])) {
		$target_dir = "uploads/";
		$idimg = $target_dir. basename($_FILES["idimg"]["name"]);
		if (move_uploaded_file($_FILES["idimg"]["tmp_name"], $idimg)) 
		{
			$idimgname = basename($_FILES["idimg"]["name"]);
		}
		
	
		$sql="UPDATE user SET verification_status = 'pending', verification_ic = '$idimgname' WHERE user_id = '$_GET[id]'";
		if (!mysqli_query($con,$sql)){
				die('Error: ' . mysqli_error($con));
			}
		else {
			echo "<script>
			window.location.href= 'profile_pg.php';
			</script>";
		}
		mysqli_close($con);}
?>
<html lang='en'>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/user_verification.css" rel="stylesheet">
    <script src="js/userverification.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        input[type="file"] {display: none;}
    </style>
</head>
<body>
<?php include ("header.php"); ?>
<div class='w-100 d-flex flex-column yellowbg flex-nowrap'>
    <div class='w-100 header_bold h2 pt-5 pb-4' style='font-size:200%'>PROFILE VERIFICATION</div>
    <div class='w-100 header_bold h6 pb-4 text-decoration-underline'>IDENTIFICATION CARD VERIFICATION</div>
    <div class='d-flex justify-content-center'> <img class='userverification_sampleid'src="img/sampleid.jpg" alt="Sample ID Card" id="sampleid"> </div>
    <div class='pt-2 pb-5'> 
        <form class='w-100 d-flex justify-content-center' method="post" name="userverification" ENCTYPE="multipart/form-data" >
        <label class="userverification_idbtn">Upload Your ID<input type="file" accept="image/jpg, image/jpeg, image/png" id="idimg" name="idimg" onchange="showimg()" required="required"></label>
        <button onclick="cancelimg()" class="userverification_btn">Cancel Image</button>
        <input class='userverification_btn'type="submit" name="userverification" value="Submit">
        </form>
    </div>
</div>
<?php include ("footer.php"); ?>
</body>
