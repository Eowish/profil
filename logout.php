<?php 
session_start();
session_destroy();
header("Location: http://localhost/profil/login2.php");