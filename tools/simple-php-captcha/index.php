<?php
session_start();
include("simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
?>