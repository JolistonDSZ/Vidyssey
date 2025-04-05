<?php
session_start();
require_once "../models/Movie.php";
require_once "../models/Favorite.php";
require_once "../models/Watchlist.php";  // ✅ Ajout du modèle Watchlist

$movies = Movie::getAllMovies();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container">
        <h1>Films disponibles</h1>
        <div class="movies-list">
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card">
                    
                    <h3><?= htmlspecialchars($movie["title"]) ?></h3>
                    <p><?= htmlspecialchars($movie["description"]) ?></p>
                    <small>Sorti en <?= $movie["release_year"] ?></small>

                    <?php if (isset($_SESSION["user_id"])): ?>
                        <?php 
                        $isFavorite = Favorite::isFavorite($_SESSION["user_id"], $movie["id"]);
                        $isInWatchlist = Watchlist::isInWatchlist($_SESSION["user_id"], $movie["id"]);
                        ?>
                        
                        <!-- Ajouter / Retirer des Favoris -->
                        <form action="../controllers/FavoriteController.php" method="POST">
                            <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                            <button type="submit" name="action" value="<?= $isFavorite ? 'remove' : 'add' ?>">
                                <?= $isFavorite ? 'Retirer des favoris' : 'Ajouter aux favoris' ?>
                            </button>
                        </form>

                        <!-- Ajouter / Retirer de la Watchlist -->
                        <form action="../controllers/WatchlistController.php" method="POST">
                            <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                            <button type="submit" name="action" value="<?= $isInWatchlist ? 'remove' : 'add' ?>">
                                <?= $isInWatchlist ? 'Retirer de la Watchlist' : 'Ajouter à la Watchlist' ?>
                            </button>
                        </form>
                    <?php else: ?>
                        <p><a href="login.php">Connectez-vous</a> pour ajouter aux favoris ou à la Watchlist.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

