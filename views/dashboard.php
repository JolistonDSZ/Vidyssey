<?php
session_start();
require_once "../models/Favorite.php";
require_once "../models/Review.php";
require_once "../models/Watchlist.php";  // ✅ Ajout du modèle Watchlist

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];
$favorites = Favorite::getFavorites($userId);
$watchlist = Watchlist::getWatchlist($userId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mon espace - Mes films</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container">
        <h1>Mes Films Favoris</h1>
        <div class="movies-list">
            <?php if (empty($favorites)): ?>
                <p>Vous n'avez aucun film en favori.</p>
            <?php else: ?>
                <?php foreach ($favorites as $movie): ?>
                    <div class="movie-card">
                        <h3><?= htmlspecialchars($movie["title"]) ?></h3>
                        <p><?= htmlspecialchars($movie["description"]) ?></p>
                        <small>Sorti en <?= $movie["release_year"] ?></small>

                        <!-- Retirer des favoris -->
                        <form action="../controllers/FavoriteController.php" method="POST">
                            <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                            <button type="submit" name="action" value="remove">Retirer des favoris</button>
                        </form>

                        <!-- Gestion des avis -->
                        <?php
                        $review = Review::getReviewByUserAndMovie($userId, $movie["id"]);
                        if ($review): ?>
                            <p><strong>Votre avis :</strong></p>
                            <p><?= htmlspecialchars($review["comment"]) ?> (Note : <?= $review["rating"] ?>/5)</p>

                            <!-- Modifier l'avis -->
                            <form action="../controllers/ReviewController.php" method="POST">
                                <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                                <input type="hidden" name="review_id" value="<?= $review["id"] ?>">
                                <textarea name="comment"><?= htmlspecialchars($review["comment"]) ?></textarea>
                                <input type="number" name="rating" value="<?= $review["rating"] ?>" min="1" max="5">
                                <button type="submit" name="action" value="update">Mettre à jour l'avis</button>
                            </form>

                            <!-- Supprimer l'avis -->
                            <form action="../controllers/ReviewController.php" method="POST">
                                <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                                <input type="hidden" name="review_id" value="<?= $review["id"] ?>">
                                <button type="submit" name="action" value="delete">Supprimer l'avis</button>
                            </form>
                        <?php else: ?>
                            <!-- Ajouter un avis -->
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
        <br>
        <br>
        <h1>Ma Watchlist</h1>
        <div class="movies-list">
            <?php if (empty($watchlist)): ?>
                <p>Votre Watchlist est vide.</p>
            <?php else: ?>
                <?php foreach ($watchlist as $movie): ?>
                    <div class="movie-card">
                        
                        <h3><?= htmlspecialchars($movie["title"]) ?></h3>
                        <p><?= htmlspecialchars($movie["description"]) ?></p>
                        <small>Sorti en <?= $movie["release_year"] ?></small>

                        <!-- Retirer de la Watchlist -->
                        <form action="../controllers/WatchlistController.php" method="POST">
                            <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                            <button type="submit" name="action" value="remove">Retirer de la Watchlist</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
