<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        First name<br>
        <input type="text" placeholder="maximum 50 character" name="user_fname" id="user_fname" pattern="[A-Za-z]{1,50}" title="should be less than 50 characters" onkeyup="nameValidation('user_fname')" required></input>
        <br><br>
        <input type="submit" name="submit">
    </form>
</body>
</html>

<?php
    if (isset($_POST['submit'])) {
        echo "you have success";
    }
?>s