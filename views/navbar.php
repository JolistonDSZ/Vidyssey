<?php
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION["user_id"])) {
    // Récupérer l'ID de l'utilisateur connecté
    $userId = $_SESSION["user_id"];

    // Récupérer les informations de l'utilisateur depuis la base de données
    require_once "../models/User.php"; // Inclure le modèle User
    $user = User::getUserById($userId); // Méthode à créer dans User.php pour récupérer un utilisateur par ID
    $userName = $user["username"]; // Le nom d'utilisateur récupéré de la base de données

    // Récupérer le rôle de l'utilisateur
    $role = User::getRole($userId); // Utiliser la méthode getRole pour obtenir le rôle de l'utilisateur
}
?>



<link rel="stylesheet" href="../css/styles.css">
<nav>
    <!-- Vérifier si l'utilisateur est connecté -->
    <?php if (isset($_SESSION["user_id"])): ?>
        <!-- Si l'utilisateur est connecté, afficher son nom et le message de bienvenue -->
        <p>Bienvenue, <?php echo htmlspecialchars($userName); ?> !</p>
        <a href="home.php">Accueil</a>
        <!-- Vérifier le rôle de l'utilisateur (admin ou standard) -->
        <?php if ($_SESSION["role"] === "admin"): ?>
            <a href="admin_dashboard.php">Espace Admin</a>
        <?php endif; ?>

        <!-- Lien vers l'espace personnel pour tous les utilisateurs -->
        <a href="dashboard.php">Espace Personnel</a>
        
        <!-- Lien pour se déconnecter -->
        <a href="../controllers/logout.php">Déconnexion</a>
    <?php else: ?>
        <!-- Si l'utilisateur n'est pas connecté, afficher les liens pour se connecter ou s'inscrire -->
        <a href="home.php">Accueil</a>
        <a href="login.php">Connexion</a>
        <a href="register.php">Inscription</a>
    <?php endif; ?>
</nav>
