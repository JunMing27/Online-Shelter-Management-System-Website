<?php
    if (isset($_SESSION["user_id"]))
    {
        require "header_user.php";
    }
    else if (isset($_SESSION["staff_id"]))
    {
        require "header_staff.php";
    }
    else
    {
        require "header_guest.php";
    }
?>