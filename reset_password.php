<?php
session_start();

include_once("pdo.php");
include('header.php');

$email = $_SESSION['email'];

$sql = "UPDATE utilisateur SET `password`='' WHERE email = '$email'";
$stmt = $pdo->prepare($sql);
$stmt-> execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifie si les deux password sont les mêmes
if(empty($_POST['password']) || empty($_POST['password2'])) {

}
else {
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if(password_verify($_POST['password2'], $password_hash)) {
        // Mise à jour des données (Update)
        $sql = "UPDATE utilisateur SET `password`='$password_hash' WHERE email = '$email'";
        $stmt = $pdo->prepare($sql);
        $stmt-> execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Location: http://localhost/profil/profile.php");
    } 
    else {
        echo "<span class='rouge'>Vos mots de passe sont différents</span>";
    }
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
    <h1>Réinitialiser le mot de passe</h1>

    <form action="reset_password.php" method="POST">
        <p>Votre email est : </p>
        <?php
        echo($email);
        ?>
        <br><br>
        <label for="password">Nouveau mot de passe</label><br>
        <input type="password" id="password" name="password" value="<?=($_POST['password'] ?? '')?>" required><br><br>
        <label for="password">Confirmer mot de passe</label><br>
        <input type="password" id="password" name="password2" required><br><br>
        <input type="submit" value="Soumettre" id="btn">
    </form>
</body>
</html>