<?php
include("conn.php");
include("sessionverifier.php");?>
<?php 
if (isset($_POST['addnewshelter'])) {
	$target_dir = "uploads/";
	$thumbnailimg = $target_dir. basename($_FILES["shelter_thumbnail"]["name"]);
	if (move_uploaded_file($_FILES["shelter_thumbnail"]["tmp_name"], $thumbnailimg)) 
	{
		$thumbnailname = basename($_FILES["shelter_thumbnail"]["name"]);
	}

	$shelterimg1 = $target_dir. basename($_FILES["simage"]["name"][0]);
	if (move_uploaded_file($_FILES["simage"]["tmp_name"][0], $shelterimg1)) 
	{
		$shelterimgname1 = basename($_FILES["simage"]["name"][0]);
	}


	$shelterimg2 = $target_dir. basename($_FILES["simage"]["name"][1]);
	if (move_uploaded_file($_FILES["simage"]["tmp_name"][1], $shelterimg2)) 
	{
		$shelterimgname2 = basename($_FILES["simage"]["name"][1]);
	}
	
	$shelterimg3 = $target_dir. basename($_FILES["simage"]["name"][2]);
	if (move_uploaded_file($_FILES["simage"]["tmp_name"][2], $shelterimg3)) 
	{
		$shelterimgname3 = basename($_FILES["simage"]["name"][2]);
	}
	
	$shelterimg4 = $target_dir. basename($_FILES["simage"]["name"][3]);
	if (move_uploaded_file($_FILES["simage"]["tmp_name"][3], $shelterimg4)) 
	{
		$shelterimgname4 = basename($_FILES["simage"]["name"][3]);
	}
	

	$sql="INSERT INTO shelter (shelter_name, shelter_street, shelter_state, shelter_city, shelter_postcode, shelter_description,amount_of_space,shelter_contact,shelter_email,shelter_thumbnail,simage_1,simage_2,simage_3,simage_4,staff_id) 
	VALUES 
	('$_POST[shelter_name]','$_POST[shelter_street]','$_POST[shelter_state]','$_POST[shelter_city]','$_POST[shelter_postcode]','$_POST[shelter_description]','$_POST[amount_of_space]','$_POST[shelter_contact]','$_POST[shelter_email]','$thumbnailname','$shelterimgname1','$shelterimgname2','$shelterimgname3','$shelterimgname4','$_SESSION[staff_id]');";
	if (!mysqli_query($con,$sql)){
			die('Error: ' . mysqli_error($con));
		}
	else {
		echo "<script>
		window.location.href= 'newshelteradded.php';
		</script>";
	}
	mysqli_close($con);}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Elderly Home's Club</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/newshelter.css" rel="stylesheet">
	<script src="js/newshelter.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		input[type=text], input[type=email], input[type=tel],input[type=number], select {
		width: 90%;
		display: inline-block;
		margin:1% 0 1% 0;
		padding: 1%;
		font-size:20px;
		border:double;
		border-radius:5px;
	}
	textarea{
		width: 90%;
		display: inline-block;
		margin:1% 0 1% 0;
		padding: 1%;
		font-size:20px;
		border:double;
		border-radius:5px;
		resize: none
	}

	input[type=file] {
		display: none;
	}
	</style>
</head>

<body>
<?php include ("header.php"); ?>
<form method="post" name="addnewshelter" ENCTYPE="multipart/form-data" >

<div class='w-100 d-flex flex-wrap addshelter_bg'>
	<div class=' w-100 text-center fw-bold addshelter_header'> New Shelter </div>
	<div class=' addshelter_formcontainer '>
		<div class='addshelter_section'>
			<div class='addshelter_label' style='padding-top:50px'> Shelter Name : </div>
			<div class='addshelter_field'>
				<input type="text" name="shelter_name" id="sname" placeholder="e.g. Minty Green" pattern="[A-Za-z0-9 ]{1,99}" title="Please enter on alphabets only" onkeyup="nameValidation()" required="required">
			</div>
		</div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Street : </div>
            <div class='addshelter_field'>
                <input type="text" name="shelter_street" id="sstreet" placeholder="e.g. 25,Taman Asia Pacific University" pattern="[A-Za-z0-9,/()#@*; ]{1,254}" title=" special characters are not allowed except ', / () # @ * ;'" onkeyup="streetValidation()" required="required">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter State : </div>
            <div class='addshelter_field'>
				<select name="shelter_state" id='statevalue' onchange="getstatevalue(this.value)" required="required">
				<option value=""disabled selected>Please select</option>
				<option value="Johor">Johor</option>
				<option value="Kedah">Kedah</option>
				<option value="Kelantan">Kelantan</option>
				<option value="Melaka">Melaka</option>
				<option value="NegeriSembilan">Negeri Sembilan</option>
				<option value="Pahang">Pahang</option>
				<option value="Penang">Penang</option>
				<option value="Perak">Perak</option>
				<option value="Perlis">Perlis</option>
				<option value="Sabah">Sabah</option>
				<option value="Sarawak">Sarawak</option>
				<option value="Selangor">Selangor</option>
				<option value="Terengganu">Terengganu</option>
				<option value="KualaLumpur">Kuala Lumpur</option>
				<option value="Labuan">Labuan</option>
				<option value="Putrajaya">Putrajaya</option>
				</select>
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter City : </div>
            <div class='addshelter_field'>
				<select name="shelter_city" id='newcity' required="required" >
				<option value=""disabled selected>Please select</option>
				</select>
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Postcode : </div>
            <div class='addshelter_field'>
                <input type="text" name="shelter_postcode" id="spostcode" placeholder="e.g. 56000" pattern="[0-9]{1,5}" title="Please enter numbers only (maximum 5 number)" onkeyup="postcodeValidation()" required="required">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Description : </div>
            <div class='addshelter_field'>
				<textarea maxlength ="1000" rows="4" id="sdesc" name="shelter_description" placeholder="e.g. this shelter can perfectly fit up to 300 people" required="required" onkeyup="DescriptionValidation()"></textarea>
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Amount Of Space : </div>
            <div class='addshelter_field'>
				<input type="number" name="amount_of_space" id="sspace" placeholder="e.g. 300 " pattern="[0-9]{1,4}" title="Please enter less than 10000 only" onkeyup="spaceValidation()" required="required">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Contact Number : </div>
            <div class='addshelter_field'>
				<input type="tel" name="shelter_contact" placeholder="e.g. 01X XXX XXXX" id="shelter_contactnum" pattern="0.{8,11}" title="phone number invalid. Phone number format starts with 01." required="required"  onkeyup="S_contactNoValidation()">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Email : </div>
            <div class='addshelter_field'>
			<input type="email" name="shelter_email" id="semail" placeholder="e.g. elderlyhomesclub@gmail.com" pattern="[A-Za-z0-9@._]{1,99}" title="Dont use special character except '@_.'" onkeyup="emailValidation()" required="required">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Thumbnail Image : </div>
			<div class='addshelter_imgfield'> <img class='addshelter_imgsize'src="img/noimage.png" alt="Thumbnail" id="thumbnailpreview"></div>
            <div class='addshelter_field'>
			<label class="addshelter_imagebtn">Upload Image<input type="file" name="shelter_thumbnail" accept="image/jpg, image/jpeg, image/png" id="thumbnailimg" onchange="showthumbnailimg()" required="required" ></label>
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Image : </div>
			<div class='addshelter_imgfield d-inline-flex overflow-auto ' id='simagediv'> 
				<img class='addshelter_imgsize'src="img/noimage.png"  alt="simage" id="simageimg1">
				<img class='addshelter_imgsize ms-1'src="img/noimage.png"  alt="simage" id="simageimg2">
				<img class='addshelter_imgsize ms-1'src="img/noimage.png"  alt="simage" id="simageimg3">
				<img class='addshelter_imgsize ms-1'src="img/noimage.png"  alt="simage" id="simageimg4">
			</div>
            <div class='addshelter_field'>
			<label class="addshelter_imagebtn">Upload Image<input type="file" name="simage[]" accept="image/jpg, image/jpeg, image/png" id="shelterimgid1" onchange="showshelterimg()" required="required" multiple></label>
			</div>
        </div>
		<div class='addshelter_section 'style='padding-left:19%;'>
            <div class='addshelter_label '> </div>
            <div class='addshelter_field '>
			<button type="submit" class="addshelter_button" name="addnewshelter">Submit</button>
			<button type="reset" class="addshelter_button" onclick="resetimg()">Reset</button>
            </div>
        </div>
	</div>
</div>



</form>
<?php include ("footer.php"); ?>
</body>
</html>
