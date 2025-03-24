<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h2>Connexion</h2>
        <form action="../controllers/UserController.php" method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="login">Se connecter</button>
        </form>
    </div>
</body>
</html>

