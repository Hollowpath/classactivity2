<?php
session_start(); // Start the session at the beginning of the script

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: ../");
exit;
?>