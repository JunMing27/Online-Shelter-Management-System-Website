<?php 
    include("conn.php");
    include("sessionverifier.php");


    if ($_SESSION['position'] = 'staff') {
        if (isset($_SESSION['login_email'])) {

            $sql_shelterInfo = "SELECT * FROM shelter WHERE shelter_id = '$_GET[id]';";
            $sql_shelterInfoQuery = mysqli_query($con, $sql_shelterInfo);
            $shelterInfo = mysqli_fetch_array($sql_shelterInfoQuery);

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
            <script src="js/staff_shelterinfomt.js"></script>
            <style>
                .shelterImage {
                    width: 100%;
                    height: 40vmax;
                    background-image: url(<?php echo $shelterImg1; ?>);
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                    animation: slide 20s infinite;
                }

                <?php if ($shelterInfo['simage_2'] == "") {?>
                    @keyframes slide{
                    100%{
                        background: url(<?php echo $shelterImg1; ?>);
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                }
                <?php } else if ($shelterInfo['simage_3'] == "") {?>
                    @keyframes slide{
                    50%{
                        background: url(<?php echo $shelterImg2; ?>);
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                    100%{
                        background: url(<?php echo $shelterImg1; ?>);
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                }
                <?php } else if ($shelterInfo['simage_4'] == "") { ?>
                    @keyframes slide{
                    33%{
                        background: url(<?php echo $shelterImg2; ?>);
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                    66%{
                        background: url(<?php echo $shelterImg3; ?>);
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                    100%{
                        background: url(<?php echo $shelterImg1; ?>);
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                }
                <?php } else { ?>
                    @keyframes slide{
                    25%{
                        background: url(<?php echo $shelterImg2; ?>);
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                    50%{
                        background: url(<?php echo $shelterImg3; ?>);
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                    75%{
                        background: url(<?php echo $shelterImg4; ?>);
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }
                    100%{
                        background: url(<?php echo $shelterImg1; ?>);
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
                    <br><br>
                    <div class="buttonContainer">
                        <div class="editbuttonn"><a class="astyle" href="staff_editshelter.php?id=<?php echo $_GET['id']; ?>">edit</a></div>
                        <div class="editbuttonn" id="fakeDeletebutton" ><a class="astyle" onclick="confirmation('Confirm to delete?')" href="#delete">delete</a></div>
                        <div class="editbuttonn" id="realDeleteButton" style="display: none;"><a class="astyle" onclick="return confirm('Confirm to delete shelter? (every information would be deleted)')" href="staff_deleteShelter.php?id=<?php echo $_GET['id']; ?>">delete</a></div>
                    </div>
                    <div id="deleteConfirmation" style="display: none;">* every booking details regarding to the shelter would be deleted, press again the delete button to delete</div>
                    </div>
                    <br><br>
                    <div class="currentlivinguser">Current Living User <span>(<?php echo $shelterInfo['occupied_space'] . "/" . $shelterInfo['amount_of_space'];?>)</span></div>
                    <div class="iframeContainer">
                        <iframe src="staff_shelterUserInfo.php?id=<?php echo $_GET['id']; ?>" height="600px" width="100%" title="Iframe Example"></iframe>
                    </div>
                    <br><br>
            </div>
            <?php include("footer.php"); ?>
        </body>
        </html>



<?php
        }
    }
?>