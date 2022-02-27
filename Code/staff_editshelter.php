<?php 
include("conn.php");
include("sessionverifier.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Elderly Home's Club</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/newshelter.css" rel="stylesheet">
	<script src="js/staff_editshelter.js"></script>
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
<?php 
include ("header.php");
$sql ="SELECT * FROM shelter WHERE shelter_id ='$_GET[id]'";
$result =mysqli_query($con, $sql);
if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_array($result);}
?>
<form method="post" name="editshelter" ENCTYPE="multipart/form-data" >

<div class='w-100 d-flex flex-wrap addshelter_bg'>
	<div class=' w-100 text-center fw-bold addshelter_header'> Edit Shelter </div>
	<div class=' addshelter_formcontainer '>
		<div class='addshelter_section'>
			<div class='addshelter_label' style='padding-top:50px'> Shelter Name : </div>
			<div class='addshelter_field'>
				<input type="text" name="shelter_name" id="sname" value="<?php echo $row['shelter_name'];?>" placeholder="e.g. John Doe" pattern="[A-Za-z0-9 ]{1,99}" title="Please enter on alphabets only"  onkeyup="nameValidation()" required="required">
			</div>
		</div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Street : </div>
            <div class='addshelter_field'>
                <input type="text" name="shelter_street" id="sstreet" value="<?php echo $row['shelter_street'];?>" placeholder="e.g. 25,Taman Asia Pacific University" pattern="[A-Za-z0-9,/()#@*; ]{1,254}" title=" special characters are not allowed except ', / () # @ * ;'" onkeyup="streetValidation()" required="required">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter State : </div>
            <div class='addshelter_field'>
				<select name="shelter_state" id='statevalue' onchange="getstatevalue(this.value)" required="required">
				<option value=""disabled selected>Please select</option>
				<option <?php if($row['shelter_state'] == 'Johor') {?> selected ='selected' <?php } ?>  value="Johor">Johor</option>
				<option <?php if($row['shelter_state'] =='Kedah') { ?> selected ='selected' <?php } ?> value="Kedah">Kedah</option>
				<option <?php if($row['shelter_state'] =='Kelantan') { ?> selected ='selected' <?php } ?> value="Kelantan">Kelantan</option>
				<option <?php if($row['shelter_state'] =='Melaka') { ?> selected ='selected' <?php } ?> value="Melaka">Melaka</option>
				<option <?php if($row['shelter_state'] =='NegeriSembilan') { ?> selected ='selected' <?php } ?> value="NegeriSembilan">Negeri Sembilan</option>
				<option <?php if($row['shelter_state'] =='Pahang') { ?> selected ='selected' <?php } ?> value="Pahang">Pahang</option>
				<option <?php if($row['shelter_state'] =='Penang') { ?> selected ='selected' <?php } ?> value="Penang">Penang</option>
				<option <?php if($row['shelter_state'] =='Perak') { ?> selected ='selected' <?php } ?> value="Perak">Perak</option>
				<option <?php if($row['shelter_state'] =='Perlis') { ?> selected ='selected' <?php } ?> value="Perlis">Perlis</option>
				<option <?php if($row['shelter_state'] =='Sabah') { ?> selected ='selected' <?php } ?> value="Sabah">Sabah</option>
				<option <?php if($row['shelter_state'] =='Sarawak') { ?> selected ='selected' <?php } ?> value="Sarawak">Sarawak</option>
				<option <?php if($row['shelter_state'] =='Selangor') { ?> selected ='selected' <?php } ?> value="Selangor">Selangor</option>
				<option <?php if($row['shelter_state'] =='Terengganu') { ?> selected ='selected' <?php } ?> value="Terengganu">Terengganu</option>
				<option <?php if($row['shelter_state'] =='KualaLumpur') { ?> selected ='selected' <?php } ?> value="KualaLumpur">Kuala Lumpur</option>
				<option <?php if($row['shelter_state'] =='Labuan') { ?> selected ='selected' <?php } ?> value="Labuan">Labuan</option>
				<option <?php if($row['shelter_state'] =='Putrajaya') { ?> selected ='selected' <?php } ?> value="Putrajaya">Putrajaya</option>
				</select>
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter City : </div>
            <div class='addshelter_field'>
                <script> getstatevalue(value="<?php echo $row['shelter_state'];?>") </script>
				<select name="shelter_city" id='newcity' required="required" >
				<option value=""disabled selected>Please select</option>
                <option <?php if($row['shelter_city'] ==$row['shelter_city']) { ?> selected ='selected' <?php } ?> value=<?php echo $row['shelter_city'] ?> > <?php echo $row['shelter_city'] ?></option>
				</select>
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Postcode : </div>
            <div class='addshelter_field'>
                <input type="text" name="shelter_postcode" id="spostcode" value="<?php echo $row['shelter_postcode'];?>" placeholder="e.g. 56000" pattern="[0-9]{1,5}" title="Please enter numbers only (maximum 5 number)" onkeyup="postcodeValidation()" required="required">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Description : </div>
            <div class='addshelter_field'>
				<textarea maxlength ="1000" rows="4" id="sdesc" name="shelter_description" placeholder="e.g. this shelter can perfectly fit up to 300 people" required="required" onkeyup="DescriptionValidation()"><?php echo $row['shelter_description'];?></textarea>
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Amount Of Space : </div>
            <div class='addshelter_field'>
				<input type="number" name="amount_of_space" id="sspace" value="<?php echo ($row['amount_of_space']);?>" placeholder="e.g. 300 " pattern="[0-9]{1,4}" title="Please enter less than 10000 only" onkeyup="spaceValidation()" required="required">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Contact Number : </div>
            <div class='addshelter_field'>
				<input type="tel" name="shelter_contact" value="<?php echo ($row['shelter_contact']);?>" placeholder="e.g. 01X XXX XXXX" id="shelter_contactnum" pattern="0.{8,11}" title="phone number invalid. Phone number format starts with 01." required="required" onkeyup="S_contactNoValidation()">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Email : </div>
            <div class='addshelter_field'>
			<input type="email" name="shelter_email" id="semail" value="<?php echo ($row['shelter_email']);?>" placeholder="e.g. elderlyhomesclub@gmail.com" pattern="[A-Za-z0-9@._]{1,99}" title="Dont use special character except '@_.'" onkeyup="emailValidation()" required="required">
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Thumbnail Image : </div>
			<div class='addshelter_imgfield'> 
                <?php 
                if ($row['shelter_thumbnail'] !=""){ echo '<img class="addshelter_imgsize" src="uploads/'.$row['shelter_thumbnail'].'"  alt="Thumbnail" id="thumbnailpreview">';}
                else { echo '<img class="addshelter_imgsize " src="img/noimage.png"  alt="Thumbnail" id="thumbnailpreview">';} 
                ?>
            </div>
            <div class='addshelter_field'>
			<label class="addshelter_imagebtn">Upload Image<input type="file" name="shelter_thumbnail" accept="image/jpg, image/jpeg, image/png" id="thumbnailimg" onchange="showthumbnailimg()" ></label>
            </div>
        </div>
		<div class='addshelter_section'>
            <div class='addshelter_label'> Shelter Image : </div>
			<div class='addshelter_imgfield d-inline-flex overflow-auto ' id='simagediv'> 
                <?php
                if ($row['simage_1'] !=""){ echo '<img class="addshelter_imgsize" src="uploads/'.$row['simage_1'].'"  alt="simage" id="simageimg1">';}
                else { echo '<img class="addshelter_imgsize " src="img/noimage.png"  alt="simage" id="simageimg1">';}
				if ($row['simage_2'] !=""){ echo '<img class="addshelter_imgsize ms-1" src="uploads/'.$row['simage_2'].'"  alt="simage" id="simageimg2">';}
                else { echo '<img class="addshelter_imgsize ms-1" src="img/noimage.png"  alt="simage" id="simageimg2">';}
				if ($row['simage_3'] !=""){ echo '<img class="addshelter_imgsize ms-1" src="uploads/'.$row['simage_3'].'"  alt="simage" id="simageimg3">';}
                else { echo '<img class="addshelter_imgsize ms-1" src="img/noimage.png"  alt="simage" id="simageimg3">';}
				if ($row['simage_4'] !=""){ echo '<img class="addshelter_imgsize ms-1" src="uploads/'.$row['simage_4'].'"  alt="simage" id="simageimg4">';}
                else { echo '<img class="addshelter_imgsize ms-1" src="img/noimage.png"  alt="simage" id="simageimg4">';}
                ?>
			</div>
            <div class='addshelter_field'>
			<label class="addshelter_imagebtn">Upload Image<input type="file" name="simage[]" accept="image/jpg, image/jpeg, image/png" id="shelterimgid1" onchange="showshelterimg()" multiple></label>
			</div>
        </div>
		<div class='addshelter_section 'style='padding-left:28%;'>
            <div class='addshelter_label '> </div>
            <div class='addshelter_field '>
			<button type="submit" class=" fs-3 addshelter_button" name="editshelter">Submit</button>
            </div>
        </div>
	</div>
</div>



</form>
<?php include ("footer.php"); ?>
</body>
</html>
<?php
if (isset($_POST['editshelter'])) {
        $checkimage ="SELECT * FROM shelter WHERE shelter_id ='$_GET[id]'";
        $imageresult =mysqli_query($con, $checkimage);
        if (mysqli_num_rows($imageresult)) {
        $imagerow = mysqli_fetch_array($imageresult);}
        $imageforthumbnail = $imagerow["shelter_thumbnail"];
        $imageforshelter1 = $imagerow["simage_1"];
        $imageforshelter2 = $imagerow["simage_2"];
        $imageforshelter3 = $imagerow["simage_3"];
        $imageforshelter4 = $imagerow["simage_4"];
        if (basename($_FILES["shelter_thumbnail"]["name"]!="")){
            $target_dir = "uploads/";
            $thumbnailimg = $target_dir. basename($_FILES["shelter_thumbnail"]["name"]);
            if (move_uploaded_file($_FILES["shelter_thumbnail"]["tmp_name"], $thumbnailimg)) 
            {
                $thumbnailname = basename($_FILES["shelter_thumbnail"]["name"]);
            }}
            else {$thumbnailname = $imageforthumbnail;}
        
        if (basename($_FILES["simage"]["name"][0]!="")){
            $target_dir = "uploads/";
            $shelterimg1 = $target_dir. basename($_FILES["simage"]["name"][0]);
            if (move_uploaded_file($_FILES["simage"]["tmp_name"][0], $shelterimg1)) 
            {
                $shelterimgname1 = basename($_FILES["simage"]["name"][0]);
            }}
            else {$shelterimgname1 = $imageforshelter1;}

        if (basename($_FILES["simage"]["name"][1] !="")){
            $target_dir = "uploads/";
            $shelterimg2 = $target_dir. basename($_FILES["simage"]["name"][1]);
            if (move_uploaded_file($_FILES["simage"]["tmp_name"][1], $shelterimg2)) 
            {
                $shelterimgname2 = basename($_FILES["simage"]["name"][1]);
            }}
            else {$shelterimgname2 = $imageforshelter2;}
		
        if (basename($_FILES["simage"]["name"][2]!="")){
            $target_dir = "uploads/";
            $shelterimg3 = $target_dir. basename($_FILES["simage"]["name"][2]);
            if (move_uploaded_file($_FILES["simage"]["tmp_name"][2], $shelterimg3)) 
            {
                $shelterimgname3 = basename($_FILES["simage"]["name"][2]);
            }}
            else {$shelterimgname3 = $imageforshelter3;}
		
        if (basename($_FILES["simage"]["name"][3]!="")){
            $target_dir = "uploads/";
            $shelterimg4 = $target_dir. basename($_FILES["simage"]["name"][3]);
            if (move_uploaded_file($_FILES["simage"]["tmp_name"][3], $shelterimg4)) 
            {
                $shelterimgname4 = basename($_FILES["simage"]["name"][3]);
            }}
            else {$shelterimgname4 = $imageforshelter4;}
		
        $sql="UPDATE shelter SET shelter_name = '$_POST[shelter_name]', shelter_street='$_POST[shelter_street]', shelter_state='$_POST[shelter_state]' , shelter_city ='$_POST[shelter_city]', shelter_postcode='$_POST[shelter_postcode]' , shelter_description='$_POST[shelter_description]' , amount_of_space='$_POST[amount_of_space]' , shelter_contact='$_POST[shelter_contact]' , shelter_email='$_POST[shelter_email]', shelter_thumbnail='$thumbnailname' , simage_1='$shelterimgname1' , simage_2='$shelterimgname2' , simage_3='$shelterimgname3' , simage_4='$shelterimgname4' ,staff_id='$_SESSION[staff_id]' WHERE shelter_id = $_GET[id];";
        if (!mysqli_query($con,$sql)){
				die('Error: ' . mysqli_error($con));
			}
		else {
			echo "<script>
			alert ('edited');
            window.location.href = 'staff_editshelter.php?id=$_GET[id]';
			</script>";
		}
		mysqli_close($con);}
?>