<?php 
    include("conn.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>home page</title>
        <link rel="stylesheet" href="css/home_pg.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header.php"); ?>
        <!-- #region 1st body -->
        <div class="containerhehe bodyfont">
            <img src="img/home_pg.png" alt="Cinque Terre" width="100%" height="auto">
            <div class="title"><span class="title1">Shelter</span><span class="title2"> Provider</span></div>
            <div class="description">Home for homeless elderly</div>
        </div>

        <!-- #endregion -->

        <!-- #region 2nd body -->
        <div class="homepg_aboutUs">
            <div class="homepg_aboutUs_title">ABOUT <span>US</span></div>
            <div class="homepg_aboutUs_dscption">Homelessness is lacking stable and appropriate housing. People can be categorized as homeless if they are: living on the streets; moving between temporary shelters, including houses of friends, family and emergency accommodation; living in private boarding houses without a private bathroom or security of tenure. </div>
            <a href="aboutus.php" class="astyle" style="text-decoration: none;"><span class="homepg_aboutUs_button">Learn more</span></a>
        </div>
        <!-- #endregion-->

        <!-- #region 3rd body -->
        <div class="homepg_services">
            <div class="homepg_services_type">
                <div class="service">Lifetime Shelter</div>
                <img src="img/homepg_lifetime.jpg" alt="Lifetime">
                <div class="descrpt">"Book shelter by one click"</div>
            </div>
            <div class="homepg_services_title">Services<br>Provided</div>
            <div class="homepg_services_type">
                <div class="service">Facilities</div>
                <img src="img/hompg_facilities.jpg" alt="facilities">
                <div class="descrpt">"Possess tons of facilities"</div>
            </div>
        </div>

        <!-- #endregion-->
        <?php include("footer.php"); ?>
    </body>
</html>