<?php
session_start();

// Connexion à la BDD
include_once('pdo.php');
include('header.php');

if(empty($_POST['email'])) {

}

// Controle du email 
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT email FROM utilisateur WHERE email = '$email'";
    $stmt = $pdo->prepare($sql);
    $stmt-> execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$result) {
        echo('Utilisateur inexistant');
    }
    else {
        $email = $_POST['email'];
    
        // Lecture des données (Read)
        $sql = "SELECT email, password FROM utilisateur WHERE email = '$email'";
        $stmt = $pdo->prepare($sql);
        $stmt-> execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if(empty($_POST['password'])) {
    
        }
        else {
            $password = $_POST['password'];
            $password_DB = $result['password'];
            $resultat_comparaison = password_verify($password, $password_DB);
    
            if($resultat_comparaison == false) {
                echo('Mauvais mdp');
            }
            else {
                echo('Bon mdp');
                $_SESSION['email'] = $email; 
                header("Location: http://localhost/profil/profile.php");
            }
        }
    }
}



    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css  ">
</head>
<body>
    <form action="login2.php" method="POST">
        <h1>Login</h1>
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email" value="<?=($_POST['email'] ?? '')?>" required><br><br>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Soumettre" id="btn">
    </form>
</body>
</html>


