<?php
if (!isset($_SESSION['login_email'])) {
    echo "<script>alert('please login to access this page');
            window.location.href = 'user_index.php';
            </script>";
}
?>