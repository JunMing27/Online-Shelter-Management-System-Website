<?php
if (isset($_POST['forgotpw_submit'])) {
		include("conn.php");
        $emailcheck = str_replace('\'', '"', $_POST['forgotpw_email']);
        $emailcheck="SELECT * FROM login WHERE login_email = '$emailcheck';";
        $rowamount = mysqli_num_rows(mysqli_query($con,$emailcheck));
        $resultemail =mysqli_query($con, $emailcheck);
        $checkadminemail = mysqli_fetch_array($resultemail);
        $secretquestioncheck="SELECT secretquestion FROM user WHERE login_email = '$_POST[forgotpw_email]';";
        $resultsecretquestion =mysqli_query($con, $secretquestioncheck);

        if (!mysqli_query($con,$emailcheck)){die('error checking'.mysqli_error($con));}
        else if ($rowamount !=1){echo "<script> alert('No email record found')</script>";}
        else if(mysqli_num_rows($resultsecretquestion)) {
                    $row = mysqli_fetch_array($resultsecretquestion);
                    if ($row['secretquestion'] !="") {echo "<script> window.location.href= 'forgotpassword2.php?email=$_POST[forgotpw_email]'; </script>";}
                    else{echo "<script> alert('email record found, but you are not eligible to change password.Please contact us for help')</script>";}
                    }
        else if($checkadminemail['login_position']=='staff'){echo "<script> alert('staff cant change password here.Please contact us for help')</script>";}
                    mysqli_close($con);}
?>
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
	input[type=email]{
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
<?php include ("header.php"); ?>
<div class='w-100 d-flex'>
    <div class='w-50 d-flex'>
        <img src="img/forgotpwimg.jpg" alt="GONG GONG PO PO" width="100%" height="100%">
    </div>
    <div class=' w-50 d-flex flex-column forgotpw'>
        <div class='w-100'><h1> Reset Password </h1> <p class='fw-bold'>After submitting your email, you will have to answer the secret question u have answered during sign up</p>
        <span class='fw-bold'>Email</span> : <form method="post"> <input type="email" name="forgotpw_email" id="forgotpw_email" placeholder="e.g. xxx@gmail.com" required="required"> &#160&#160
        <input class="forgotpw_link" name="forgotpw_submit" type="submit" value="Submit"></form> 
        </div> 
    </div>
</div>
<?php include ("footer.php"); ?>
</body>
</html>