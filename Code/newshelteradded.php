<?php
include("conn.php");
include("sessionverifier.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Elderly Home's Club</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/newshelteradded.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php 
include ("header.php"); ?>
<div class='w-100 d-flex yellowbg' >
    <div class=' addedshelter_seccontainer '>
    <h1> NEW SHELTER ADDED </h1>
    <p class='fw-bold'> You have added a new shelter successfully </p> 
    <button class='addedshelter_btn' onclick="document.location='staff_shelter.php'">View All Shelters</button>
    <button class='addedshelter_btn' onclick="document.location='newshelter.php'">Add New Shelter</button>
    </div>
</div>
<?php include ("footer.php"); ?>
</body>
</html>