<?php
session_start();
require_once "../models/Movie.php";
require_once "../models/Favorite.php";  // Ajout pour vérifier si le film est un favori
$movies = Movie::getAllMovies();
?>

<!DOCTYPE html>
<html>
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
                    <!-- Afficher l'image du film -->
                    <?php if (!empty($movie["image_url"])): ?>
                        <img src="<?= htmlspecialchars($movie["image_url"]) ?>" alt="<?= htmlspecialchars($movie["title"]) ?>" class="movie-image">
                    <?php else: ?>
                        <p>Aucune image disponible</p>
                    <?php endif; ?>
                    
                    <h3><?= htmlspecialchars($movie["title"]) ?></h3>
                    <p><?= htmlspecialchars($movie["description"]) ?></p>
                    <small>Sorti en <?= $movie["release_year"] ?></small>

                    <?php if (isset($_SESSION["user_id"])): ?>
                        <?php 
                        // Vérifier si ce film est déjà dans les favoris
                        $isFavorite = Favorite::isFavorite($_SESSION["user_id"], $movie["id"]);
                        ?>
                        <?php if ($isFavorite): ?>
                            <!-- Si c'est déjà un favori, afficher un bouton pour le retirer -->
                            <form action="../controllers/FavoriteController.php" method="POST">
                                <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                                <button type="submit" name="action" value="remove">Retirer des favoris</button>
                            </form>
                        <?php else: ?>
                            <!-- Sinon, afficher un bouton pour l'ajouter aux favoris -->
                            <form action="../controllers/FavoriteController.php" method="POST">
                                <input type="hidden" name="movie_id" value="<?= $movie["id"] ?>">
                                <button type="submit" name="action" value="add">Ajouter aux favoris</button>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <p><a href="login.php">Connectez-vous</a> pour ajouter en favoris.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
