<?php

include 'connect.php';
session_start();
session_destroy();

header('location:../admin_panel/login.php');
?>