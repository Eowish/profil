<?php 
session_start();

include("header.php");

// Connexion à la BDD
$dsn = "mysql:host=localhost;dbname=mds";
$user = "root";
$pass = "";
$pdo = new \PDO($dsn, $user, $pass);

// Vérifie si l'email à bien été écrit 
if((filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) == false) {
    echo "<span class='rouge'>L'email n'est pas correct</span>";
}


// Vérifie si les deux password sont les mêmes
else {
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if(password_verify($_POST['password2'], $password_hash)) {
        // Insertion de l'utilisateur dans la BDD
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "INSERT INTO `utilisateur`(`email`, `password`) VALUES ('$email', '$password_hash')";
        $stmt = $pdo->prepare($sql);
        $stmt-> execute();
        $result = $stmt->fetchAll();
        echo "Vous avez <span class='vert'>créé votre compte !</span><br>";
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
    
</body>
</html>


<style>
    .vert {
        color: green;
    }

    .rouge {
        color: red;
    }
</style>
<body>
    <form action="register.php" method="POST">
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email" value="<?=($_POST['email'] ?? '')?>" required><br><br>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" value="<?=($_POST['password'] ?? '')?>" required><br><br>
        <label for="password">Confirmer mot de passe</label><br>
        <input type="password" id="password" name="password2" required><br><br>
        <input type="submit" value="Soumettre" id="btn">
    </form>
</body>
</html>