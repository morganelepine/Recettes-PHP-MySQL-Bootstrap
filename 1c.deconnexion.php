<?php
session_start();
session_destroy();
header('location: ./1b.login.php');
exit;
?>