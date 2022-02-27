<?php
include("conn.php");
include("sessionverifier.php"); ?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/staff_shelter.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <?php include ("header.php");?>
        <div class="title">Current Shelter</div>
        <div class="main_box">
            <div class="searchbarContainer">
                <form method="post">
                    <input class="text-center" type="text" name="sheltername" id="sheltername" placeholder="Search by name, city, state, postcode" onkeyup="searchbar(value)">
                </form>
            </div>
            <div id="shelterinfo" class="main_box"></div>
        </div>
        <!-- Staff search input (AJAX) -->
        <script>
        function searchbar(sheltername="")
        {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById('shelterinfo').innerHTML = this.responseText;
            }
            xhttp.open("GET", "staff_sheltersearch.php?sheltername="+sheltername);
            xhttp.send();
        }
        searchbar();
        </script>
        <br><br><br>
        <?php include ("footer.php"); ?>
    </body>
</html>