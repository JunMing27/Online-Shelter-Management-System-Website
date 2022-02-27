<?php
    include("conn.php");

    $username = $_GET['username'];
    $username = str_replace('\'', '"', $username);

    if ($username == ""){
        $sql_alluser = "SELECT DISTINCT s.user_id, user_fname, user_lname, user_pp, user_gender, start_date
        FROM shelterbooking s INNER JOIN user u ON s.user_id = u.user_id
        WHERE s.shelter_id = '$_GET[id]'";
    }
    else
    {
        $sql_alluser = "SELECT DISTINCT s.user_id, user_fname, user_lname, user_pp, user_gender, start_date 
        FROM shelterbooking s INNER JOIN user u ON s.user_id = u.user_id 
        WHERE (CONCAT_WS(' ',user_fname,user_lname) LIKE '%".$username."%') AND (s.shelter_id = '$_GET[id]');";
    }

    $sqlQuery = mysqli_query($con, $sql_alluser);

?>

<!-- my part -->
<?php
    $noinfo_box='<div class="main_box "><img class="imagecenter" src="img/nodata.png" alt="no data found" width="700px" height="400px"> </div>';
    $rowamount = mysqli_num_rows($sqlQuery);
    if ($rowamount ==0){
        echo $noinfo_box;
    } else { while ($alluser = mysqli_fetch_array($sqlQuery)) {

        $username = $alluser['user_fname'] . ' ' . $alluser['user_lname'];

        if ($alluser['user_pp'] == ''){
            if ($alluser['user_gender'] == 'male'){
                $ppSource ='img/5e5356897371bb93979e09cd_peep-42.png';
            } else if ($alluser['user_gender'] == 'female'){
                $ppSource = 'img/5e535d897488c25a204b12ff_peep-102.png';
            }
        } else {
            $ppSource = "uploads/" . $alluser['user_pp'];
        }

        $results = '<div class="MainUserContainer">
        <div class="profileP"><a href="staff_shelterCurrentLivingUserInfo.php?id='.$alluser['user_id'].'"><img src="'.$ppSource.'" alt="profile picture"></a></div>
            <div class="userDetail"><a href="staff_shelterCurrentLivingUserInfo.php?id='.$alluser['user_id'].'">
                <div>name : '.$username.'</div><br>
                <div>start from : '.$alluser['start_date'].'
            </a></div>
        </div>
            <div class="removeButton">
                    <form method="POST" class="cancelbutton">
                        <input type="text" name="userID" style="display: none;" value="'.$alluser['user_id'].'">
                        <input type="submit" name="removeUser" value="" onclick="return confirm('."Confirm to remove user ?".')">
                    </form>
            </div>
        </div>';

        echo $results;
        
        ?>

    <?php } 
    } mysqli_close($con); ?>