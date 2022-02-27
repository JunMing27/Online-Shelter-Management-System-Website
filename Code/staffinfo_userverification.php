<?php
include("conn.php");
include("sessionverifier.php"); ?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/staffinfo_userverification.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <?php
    include ("header.php");
    ?>
        <div class="title">User Verification</div>
        <div class="main_box">
            <div class="searchbarContainer">
                <form method="post">
                    <input class="text-center" type="text" name="userfirstname" id="userfirstname" placeholder="Search" onkeyup="searchbar(value)">
                </form>
            </div>
        </div>

        <div id="pendinguser" class="main_box"></div>
        <!-- Staff search input (AJAX) -->

        <script>
        function searchbar(fname="")
        {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById('pendinguser').innerHTML = this.responseText;
            }
            xhttp.open("GET", "staffinfo_userverificationsearch.php?firstname="+fname);
            xhttp.send();
        }
        searchbar();
        </script>
        <br><br><br>
        <?php include ("footer.php");?>
    </body>
</html>