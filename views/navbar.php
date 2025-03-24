<link rel="stylesheet" href="../css/styles.css">
<nav>
    <a href="home.php">Accueil</a>
    <?php if (isset($_SESSION["user_id"])): ?>
        <a href="dashboard.php">Espace Personnel</a>
        <a href="../controllers/logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="login.php">Connexion</a>
        <a href="register.php">Inscription</a>
    <?php endif; ?>
</nav>
