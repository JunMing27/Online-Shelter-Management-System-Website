<?php
    include("conn.php");

    $username = $_GET['username'];
    $username = str_replace('\'', '"', $username);
    if ($_SESSION['position'] = 'staff') {
        if (isset($_SESSION['login_email'])) {
            
            if ($username == ""){
                $sql_userInfo = "SELECT * FROM user";
            }
            else
            {
                $sql_userInfo = "SELECT * FROM user WHERE CONCAT_WS(' ',user_fname,user_lname) LIKE '%".$username."%'";
            }

            $sqlQuery = mysqli_query($con, $sql_userInfo);

            $noinfo_box='<div class="main_box "><img src="img/nodata.png" alt="no data found" width="700px" height="400px"> </div>';
            $rowamount = mysqli_num_rows($sqlQuery);
            if ($rowamount ==0){
                echo $noinfo_box;
            } else { while ($userInfo = mysqli_fetch_array($sqlQuery)) { 

                $id = $userInfo['user_id'];
                $pp = $userInfo['user_pp'];
                $gender = $userInfo['user_gender'];
                $fname = $userInfo['user_fname'];
                $lname = $userInfo['user_lname'];
                $name = $userInfo['user_fname'] . $userInfo['user_lname'];
                $verificationStatus = $userInfo['verification_status'];


                if ($pp == ""){
                    if ($gender == 'male'){
                        $ppSource ='img/5e5356897371bb93979e09cd_peep-42.png';
                    } else if ($gender == 'female'){
                        $ppSource = 'img/5e535d897488c25a204b12ff_peep-102.png';
                    }
                } else {
                    $ppSource = "uploads/" . $pp;
                }


                        $results = '<div class="info">
                        <a class="singleInfo" href="staffinfo_detailUserInfo.php?id='.$id.'">
                            <div class="singleInfo_pp"><img src="'.$ppSource.'" alt="profile picture"></div>
                            <div class="singleInfo_info">
                                <div class="singleInfo_info_inner">'.$name.'<br><br>id :'.$id.'</div>
                            </div>
                            <div class="singleInfo_availability">';



                                if ($verificationStatus == "unverified") {
                                    $results2 = '<div class="singleInfo_availability_inner" style="color: red;">'.$verificationStatus.'</div></div>
                                    </a>
                                </div>';
                                } else if ($verificationStatus == "verified") {
                                    $results2 = '<div class="singleInfo_availability_inner" style="color: greenyellow;">'.$verificationStatus.'</div></div>
                                    </a>
                                </div>';
                                } else if ($verificationStatus == "pending") {
                                    $results2 = '<div class="singleInfo_availability_inner" style="color: grey;">'.$verificationStatus.'</div></div>
                                    </a>
                                </div>';
                                }
                        
                                echo $results . $results2;

                 }
                 mysqli_close($con);
            }
        }

    }

?>