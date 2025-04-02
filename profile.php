<?php
session_start();
// visualiser les infos de son compte si on est authentifié 
// si non connecté alors renvoyer vers une authentification

include_once("pdo.php");
include('header.php');

$email = $_SESSION['email'];
if(!isset($_SESSION['email'])) {
    header("Location: http://localhost/profil/logout");
}
else {
    echo("Vous êtes connecté");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Profil</h1>
    <?php
    echo($email);
    echo('<br><a href="reset_password.php">Réinitialiser le mot de passe</a>');
    echo('<br><a href="logout.php">Se déconnecter</a>');
    ?>
</body>
</html>



