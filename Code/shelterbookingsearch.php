<!DOCTYPE html>
<html>
<body>
        <!-- #region user view shelter page -->
    <?php
    include ("conn.php");
   $shelterinfo = $_GET['sheltername'];
   $shelterinfo = str_replace('\'', '"', $shelterinfo);     
   if ($shelterinfo == ""){
       $sql="SELECT * FROM shelter ";
   }
   else
   {
       $sql="SELECT * FROM shelter WHERE CONCAT_WS(' ',shelter_name,shelter_street,shelter_postcode,shelter_city,shelter_state,shelter_contact) LIKE '%".$shelterinfo."%'";
   }   
   $result = mysqli_query($con,$sql);
   $noinfo_box='<div class="main_box "> <img class="imagecenter" src="img/nodata.png" alt="no data found" width="700px" height="400px"> </div>';
    $rowamount = mysqli_num_rows($result);
    if ($rowamount ==0){
        echo $noinfo_box;
    }
    else{
        while($row=mysqli_fetch_array($result)){ 
            $availablespace = $row["amount_of_space"];
            $occupiedspace =$row ["occupied_space"];
            $availability =(number_format($availablespace)-number_format($occupiedspace));
            if ($availability <=0){
                $availability = "unavailable";
            }
            else if ($availability >0){
                $availability = strval($availability)." slot(s) left";
            }
            $info_box='
                <div class="info ">
                    <a class="singleInfo" href="shelterbooking.php?id='.$row["shelter_id"].'">
                        <div class="singleInfo_pp"><img style="width: 110px;height: 130px;" src="uploads/'.$row ["shelter_thumbnail"].'"></div>
                        <div class="singleInfo_info">
                            <div class="singleInfo_info_inner">&nbsp;&nbsp;<span class="fw-bold text-decoration-underline">Shelter Information</span><br>&nbsp;&nbsp;Name : '.$row ["shelter_name"].' <br>&nbsp;&nbsp;City : '.$row ["shelter_city"].'<br>&nbsp;&nbsp;State : '.$row ["shelter_state"].'<br>&nbsp;&nbsp;Postcode : '.$row ["shelter_postcode"].'</div>
                        </div>
                        <div class="singleInfo_availability">
                            <div class="singleInfo_availability_inner pt-2"> <span class=" fs-6 fw-bold text-decoration-underline">Available Space</span> <br><br>'.$availability.' </div>
                        </div>
                    </a>
                </div>';
                echo $info_box;
            };};
        mysqli_close($con);?>
        <!-- #endregion -->
    </body>
</html>