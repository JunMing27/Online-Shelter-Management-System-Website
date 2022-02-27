<!DOCTYPE html>
<html>
<head>
    <title> Login </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
<?php include ("header.php"); ?>
<div class='w-100 d-flex yellowcolorBackground'>
    <div class='w-50 d-flex'>
        <img src="img/forgotpwimg.jpg" alt="GONG GONG PO PO" width="100%" height="100%">
    </div>
    <div class=' w-50 d-flex flex-column someMargin'>
    <form action="user_login.php " class="w-100 floatrightpls" method="post">
        <div class= image>
        <h2>Login</h2>
        <?php if(isset($_GET['error'])) {?>
            <p class="error"> <?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label> Email </label> 
        <label for="login_email"></label> 
        <input type="text" placeholder="Email" name="uemail" value="<?php if(isset($_COOKIE["cookieemail"])){echo $_COOKIE["cookieemail"];}?>"> 
        
        <label> Password </label>
        <input type="password" placeholder="Password" name="upass">
            
        <button type="submit" name="login">Login</button>
        <input type="button" onclick="location.href='signup_pg.php';" value="sign up">
        <br>
        <label>
        <input type="checkbox" name="remember" id = "remember"> Remember me
        </label>
        <br>
        <span class="password"> <a href="forgotpassword.php">Forgot password?</a></span>
        <br>

        </div>
    </form>
    </div>
</div>
    
    <?php include ("footer.php"); ?>
</body>
</html>