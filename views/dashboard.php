<?php
session_start();
require_once "../models/Favorite.php";
require_once "../models/Review.php";

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Récupérer tous les films favoris de l'utilisateur
$favorites = Favorite::getFavorites($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mon espace - Mes films favoris</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h1>Mes films favoris</h1>
        <div class="movies-list">
            <?php if (empty($favorites)): ?>
                <p>Vous n'avez aucun film favori.</p>
            <?php else: ?>
                <?php foreach ($favorites as $movie): ?>
                    <div class="movie-card">
                        <h3><?= htmlspecialchars($movie["title"]) ?></h3>
                        <p><?= htmlspecialchars($movie["description"]) ?></p>
                        <small>Sorti en <?= $movie["release_year"] ?></small>

                        <!-- Formulaire pour retirer le film des favoris -->
                        <form action="../controllers/FavoriteController.php" method="POST">
                            <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movie["id"]) ?>">
                            <button type="submit" name="action" value="remove">Retirer des favoris</button>
                        </form>

                        <!-- Formulaire pour ajouter un avis si aucun avis n'est encore laissé -->
                        <?php
                        // Vérifier si l'utilisateur a déjà ajouté un avis pour ce film
                        $review = Review::getReviewByUserAndMovie($_SESSION["user_id"], $movie["id"]);
                        if ($review): ?>
                            <p><strong>Votre avis :</strong></p>
                            <p><?= htmlspecialchars($review["comment"]) ?> (Note : <?= $review["rating"] ?>/5)</p>
                            <!-- Formulaire pour modifier l'avis -->
                            <form action="../controllers/ReviewController.php" method="POST">
                                <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                                <input type="hidden" name="review_id" value="<?= $review["id"] ?>">
                                <textarea name="comment"><?= htmlspecialchars($review["comment"]) ?></textarea>
                                <input type="number" name="rating" value="<?= $review["rating"] ?>" min="1" max="5">
                                <button type="submit" name="action" value="update">Mettre à jour l'avis</button>
                            </form>
                            <!-- Formulaire pour supprimer l'avis -->
                            <form action="../controllers/ReviewController.php" method="POST">
                                <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                                <input type="hidden" name="review_id" value="<?= $review["id"] ?>">
                                <button type="submit" name="action" value="delete">Supprimer l'avis</button>
                            </form>
                        <?php else: ?>
                            <!-- Formulaire pour ajouter un avis si aucun avis n'existe encore -->
                            <form action="../controllers/ReviewController.php" method="POST">
                                <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                                <textarea name="comment" placeholder="Laissez un avis..."></textarea>
                                <input type="number" name="rating" min="1" max="5" placeholder="Note (1-5)">
                                <button type="submit" name="action" value="add">Ajouter un avis</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
