<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Elderly Home's Club</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/header.css" rel="stylesheet">
<link href="css/forgotpw.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	input[type=text]{
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
<?php
include("conn.php");
include ("header.php"); 
$sql="SELECT * FROM user WHERE login_email = '$_GET[email]';";
$result = mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
$answerques='
<div class="w-100 d-flex">
    <div class="w-50 d-flex">
        <img src="img/forgotpwimg.jpg" alt="GONG GONG PO PO" width="100%" height="100%">
    </div>
    <div class=" w-50 d-flex flex-column forgotpw">
        <div class="w-100"><h1 class="text-decoration-underline">Special Question </h1> <br>
		<span class="fw-bold">Question : '.$row["secretquestion"].' <br><br> Answer : </span><form method="post"> <input type="text" name="answer" id="answer" required="required"> &#160&#160
        <input class="forgotpw_link" name="questionanswer" type="submit" value="Submit"></form> 
        </div> 
    </div>
</div>';
echo $answerques;

if (isset($_POST['questionanswer'])) {
        $anscheck = str_replace('\'', '"', $_POST['answer']);
        $anscheck="SELECT * FROM user WHERE secretanswer = '$anscheck' AND login_email = '$_GET[email]';";
        if (!mysqli_query($con,$anscheck)){
            die('error checking'.mysqli_error($con));
        }else{
            $rowamount = mysqli_num_rows(mysqli_query($con,$anscheck));
            if ($rowamount !=1){
                echo "<script> alert('Wrong answer entered')</script>";}
                    else {
                        echo "<script>
                        window.location.href ='passwordrecover.php?email=$_GET[email]'</script>";}
            }mysqli_close($con);}
include ("footer.php"); ?>
</body>
</html>