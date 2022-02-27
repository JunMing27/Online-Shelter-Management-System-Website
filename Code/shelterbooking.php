<?php
    include('conn.php');

    $sql_shelterInfo = "SELECT * FROM shelter WHERE shelter_id = '$_GET[id]';";
    $sql_shelterInfoQuery = mysqli_query($con, $sql_shelterInfo);
    $shelterInfo = mysqli_fetch_array($sql_shelterInfoQuery);

    if (isset($_SESSION['user_id'])){
        $sql_bookingInfo = "SELECT * FROM shelterbooking WHERE user_id = '$_SESSION[user_id]';";
        $sql_bookingInfoQuery = mysqli_query($con, $sql_bookingInfo);
        $bookingInfo = mysqli_fetch_array($sql_bookingInfoQuery);

        $sql_userInfo = "SELECT * FROM user WHERE user_id = '$_SESSION[user_id]';";
        $sql_userInfoQuery = mysqli_query($con, $sql_userInfo);
        $userInfo = mysqli_fetch_array($sql_userInfoQuery);

        $userVerificationStatus = $userInfo['verification_status'];
    }

    $shelterImg1 = "uploads/" . $shelterInfo['simage_1'];
    $shelterImg2 = "uploads/" . $shelterInfo['simage_2'];
    $shelterImg3 = "uploads/" . $shelterInfo['simage_3'];
    $shelterImg4 = "uploads/" . $shelterInfo['simage_4'];
    
    $shelterName = $shelterInfo['shelter_name'];
    $shelterDes = $shelterInfo['shelter_description'];
    $shelterAddress = $shelterInfo['shelter_street'] . ", " . $shelterInfo['shelter_postcode'] . ", " .$shelterInfo['shelter_city'] . ", " .$shelterInfo['shelter_state'];
    $shelterContact = $shelterInfo['shelter_contact'];
    $shelterEmail = $shelterInfo['shelter_email'];
    $availableSpace = intval($shelterInfo['amount_of_space']) - intval($shelterInfo['occupied_space']);

    if ($availableSpace == 0) {
        $availability = 'unavailable';
    } else if ($availableSpace > 0){
        $availability = 'available';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelter</title>
    <link rel="stylesheet" href="css/shelterbooking.css">
    <style>
        .shelterImage {
            width: 100%;
            height: 40vmax;
            background-image: url('<?php echo $shelterImg1; ?>');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            animation: slide 20s infinite;
        }

        <?php if ($shelterInfo['simage_2'] == "") {?>
            @keyframes slide{
            100%{
                background: url('<?php echo $shelterImg1; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        }
        <?php } else if ($shelterInfo['simage_3'] == "") {?>
            @keyframes slide{
            50%{
                background: url('<?php echo $shelterImg2; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            100%{
                background: url('<?php echo $shelterImg1; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        }
        <?php } else if ($shelterInfo['simage_4'] == "") { ?>
            @keyframes slide{
            33%{
                background: url('<?php echo $shelterImg2; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            66%{
                background: url('<?php echo $shelterImg3; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            100%{
                background: url('<?php echo $shelterImg1; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        }
        <?php } else { ?>
            @keyframes slide{
            25%{
                background: url('<?php echo $shelterImg2; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            50%{
                background: url('<?php echo $shelterImg3; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            75%{
                background: url('<?php echo $shelterImg4; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            100%{
                background: url('<?php echo $shelterImg1; ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        }
        <?php } ?>
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="mainContainer">
        <div class="shelterImage"></div>
        <div class="shelterContent">
            <div class="shelterName">
                <?php echo $shelterName; ?>
                <?php if ($availability == 'available') {
                    echo "<span class='shelterAvailability' style='color: green;'>" . $availableSpace . " " . $availability . "</span>";
                } else if ($availability == 'unavailable') {
                    echo "<span class='shelterAvailability' style='color: red;'>" . $availability . "</span>";
                } ?>
            </div>
            <div class="shelterDes"><?php echo $shelterDes; ?></div>
            <div class="shelterDetails">
                <ul>
                    <li><?php echo $shelterAddress; ?></li>
                    <li><?php echo $shelterContact; ?></li>
                    <li><?php echo $shelterEmail; ?></li>
                </ul>
            </div>

            <?php if ($availability == 'unavailable') { ?>
                <form method="POST">
                    <input type="submit" class="unavailable" value="unavailable" disabled>
                </form>
            <?php } else if (isset($_SESSION['user_id'])){

                    if ($userVerificationStatus == 'unverified' || $userVerificationStatus == 'pending'){ ?>
                        <form method="POST">
                            <input type="submit" class="unavailable" value="unavailable" disabled><div class="errormessage"> * please verify your identity card to book</div>
                        </form>
                    <?php } else {
                    $rowAmount = mysqli_num_rows($sql_bookingInfoQuery);

                    if ($rowAmount > 0){ 
                        if ($bookingInfo['shelter_id'] == $_GET['id']){?>
                            <form method="POST">
                                <input type="submit" class="available" value="cancel" name="cancelbooking" >
                            </form>
                        <?php } else if ($bookingInfo['shelter_id'] != $_GET['id']){?>
                            <form method="POST">
                                <input type="submit" class="available" value="booked" disabled> <div class="errormessage"> * already booked for another shelter</div>
                            </form>
                        <?php }
                        } else if($rowAmount == 0){ ?>
                            <form method="POST">
                                <input type="submit" class="available" name="booking" value="book">
                            </form>
                        <?php } 
                        }
                } else if (!isset($_SESSION['user_id'])){ ?>
                        <form method="POST">
                            <input type="submit" class="available" value="book" disabled> <div class="errormessage"> * Please sign in to book</div>
                        </form>
                <?php } ?>

        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>

<?php 

if (isset($_POST['cancelbooking'])) {
    // delete booking details
    // minus occupied space

    $sql_deleteBookingContract = "DELETE FROM shelterbooking WHERE (shelter_id = '$_GET[id]') AND (user_id = '$_SESSION[user_id]');";
    $minusos = intval($shelterInfo['occupied_space']) - 1;
    $sql_minusOccupied_space = "UPDATE shelter SET
    occupied_space = '$minusos'
    WHERE shelter_id = '$_GET[id]'";

    if (!mysqli_query($con,$sql_deleteBookingContract)){
        die("cancel error" . mysqli_error($con));
    } else {
        if (!mysqli_query($con,$sql_minusOccupied_space)){
            die("minus occupied_space error" . mysqli_error($con));
        } else {
            echo "<script>alert('Successfully cancel');
            window.location.href = 'shelterbooking.php?id=".$_GET['id']."';
            </script>";
        }
    }
}

if (isset($_POST['booking'])) {
    $datee = date("Y-m-d");
    $sql_addBookingContract = "INSERT INTO shelterbooking (start_date, 	user_id, shelter_id ) VALUES ('$datee', '$_SESSION[user_id]', '$_GET[id]');";
    $addos = intval($shelterInfo['occupied_space']) + 1;
    $sql_addOccupied_space = "UPDATE shelter SET
    occupied_space = '$addos'
    WHERE shelter_id = '$_GET[id]'";
    
    if (!mysqli_query($con,$sql_addBookingContract)){
        die("add contract error" . mysqli_error($con));
    } else {
        if (!mysqli_query($con,$sql_addOccupied_space)){
            die("add occupied_space error" . mysqli_error($con));
        } else {
            echo "<script>alert('Successfully booked');
            window.location.href = 'shelterbooking.php?id=".$_GET['id']."';
            </script>";
        }
    }
}