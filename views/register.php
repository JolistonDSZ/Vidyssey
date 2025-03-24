<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h2>Inscription</h2>
        <form action="../controllers/UserController.php" method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="register">S'inscrire</button>
        </form>
    </div>
</body>
</html>
