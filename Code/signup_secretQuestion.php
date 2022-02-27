<?php
    include("conn.php");
    if (isset($_SESSION['login_email'])){ 
        if ($_SESSION['position'] = "user") {
?>

            <html>
                <head>
                    <title>Secret Password</title>
                    <link rel="stylesheet" href="css/signup_pg.css">
                    <script src="js/signup_pg.js"></script>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <?php include("header.php"); ?>
                    <div class="portion1">
                        <div class="portion1_1"><img src="img/care.jpg" alt=""></div>
                        <div class="portion1_2">
                            <!-- <div class="errorMessage" id="errorMessage">error</div> -->
                            <div class="title">Successfully signed up<br></div>
                            <div>Here's a question for you (It will help you if you forgot your password)</div>
                            <form method="post">
                                <select class="dropdownbox" name="question">
                                    <option value="1">What is the name of your best friend from childhood?</option>
                                    <option value="2">What is your first job?</option>
                                    <option value="3">What is the favourite place that you love the most?</option>
                                </select>
                                <div id="textvalidation" style="display: none; color: red;">the symbol ' is not allow to use</div>
                                <br><input type="text" placeholder="maximum 100 character" name="secretPassword" id="secretPassword" pattern=".{1,100}" onkeyup="nameValidation('secretPassword', 100)" required></input>
                                <br><br>
                                <input type="submit" name="submit" value="Confirm">
                            </form>
                            <br><br><br><br>
                        </div>
                    </div>
                    <?php include("footer.php"); ?>
                </body>
            </html>

 <?php
            if(isset($_POST['submit'])){

                $vldt = str_replace("'","",$_POST['secretPassword']);

                if ($vldt === $_POST['secretPassword']) {
                    $confirmValidation = true;
                } else {
                    echo "<script>document.getElementById('textvalidation').style.display = 'inline-block';</script>";
                    $confirmValidation = false;
                }
                
                if ($confirmValidation == true) {

                    if ($_POST['question'] == "1") {
                        $secretQuestion = "What is the name of your best friend from childhood?";
                    } else if ($_POST['question'] == "2") {
                        $secretQuestion = "What is your first job?";
                    } else if ($_POST['question'] == "3") {
                        $secretQuestion = "What is the favourite place that you love the most?";
                    }

                    $sqlAppend = "UPDATE user SET 
                    secretquestion = '$secretQuestion',
                    secretanswer = '$_POST[secretPassword]'
        
                    WHERE login_email = '$_SESSION[login_email]';";

                    if(!mysqli_query($con, $sqlAppend)){
                        die('error'.mysqli_error($con));
                    }else{
                        echo "<script>window.location.href = 'home_pg.php';</script>";
                    }
                }
            }
        }
    }
?>