<?php 
require_once("../Functions/https_secure_connection.php");

session_start();

session_unset();
session_destroy();

header("Location: home.php");
exit;