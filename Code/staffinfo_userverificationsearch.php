<!DOCTYPE html>
<html>
<body>
        <!-- #region staff information view user verification page -->
    <?php
    include ("conn.php");
   $userfirstname = $_GET['firstname'];
   $userfirstname = trim($userfirstname);
    $userfirstname = stripslashes($userfirstname);
    $userfirstname = htmlspecialchars($userfirstname);
    $userfirstname = str_replace('\'', '"', $userfirstname);
   if ($userfirstname == ""){
       $sql="SELECT * FROM user WHERE verification_status = 'pending' ";
   }
   else
   {   
       $sql="SELECT * FROM user WHERE verification_status = 'pending'AND CONCAT_WS(' ',user_fname,user_lname) LIKE '%".$userfirstname."%'";
   }   
   $result = mysqli_query($con,$sql);
   $rowamount = mysqli_num_rows($result);
   $noinfo_box='<div class="main_box "> <img class="imagecenter" src="img/nodata.png" alt="no data found" width="700px" height="400px"> </div>';
   if ($rowamount ==0){
       echo $noinfo_box;
   }
   else{
    while($row=mysqli_fetch_array($result)){ 
        if ($row["user_pp"] == ""){
            if ($row ["user_gender"] == 'male'){
                $ppSource = 'img/5e5356897371bb93979e09cd_peep-42.png';
            } else if ($row ["user_gender"] == 'female'){
                $ppSource = 'img/5e535d897488c25a204b12ff_peep-102.png';
            }
        } else {
            $ppSource = "uploads/" . $row["user_pp"];
        }
        $info_box='
            <div class="info ">
                <a class="singleInfo" href="staffinfo_userverification2.php?id='.$row["user_id"].'">
                    <div class="singleInfo_pp"><img style="width: 110px;height: 130px;" src="'.$ppSource.'"></div>
                    <div class="singleInfo_info">
                        <div class="singleInfo_info_inner">&nbsp;&nbsp;User. Name : '.$row ["user_fname"].'&nbsp;'.$row["user_lname"].' <br><br> &nbsp;&nbsp;User ID : '.$row ["user_id"].'</div>
                    </div>
                    <div class="singleInfo_availability">
                        <div class="singleInfo_availability_inner"> <span class=" fs-6 fw-bold text-decoration-underline"><br>Status</span> <br><br><span class="text-uppercase">'.$row ["verification_status"].'</span></div>
                    </div>
                </a>
            </div>';
        echo $info_box;}}
        mysqli_close($con);?>
        <!-- #endregion -->
    </body>
</html>