<?php

// require_once "components/config.php";

session_start();
session_destroy();

header("location: ../index.php?msg=Logout Successfully!");

                
?>