<?php
session_start();
require_once "../models/Movie.php";
require_once "../models/Review.php";

if (!isset($_GET["movie_id"])) {
    die("Film non trouvé.");
}

$movieId = $_GET["movie_id"];
$movie = Movie::getMovieById($movieId);
$reviews = Review::getReviews($movieId);

if (!$movie) {
    die("Film non trouvé.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Film - <?= htmlspecialchars($movie["title"]) ?></title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h1><?= htmlspecialchars($movie["title"]) ?></h1>
        <p><?= htmlspecialchars($movie["description"]) ?></p>
        <small>Sorti en <?= $movie["release_year"] ?></small>

        <h2>Avis</h2>
        <div class="reviews">
            <?php if (empty($reviews)): ?>
                <p>Il n'y a pas encore d'avis pour ce film.</p>
            <?php else: ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <p><strong><?= htmlspecialchars($review["username"]) ?> :</strong> 
                            <?= htmlspecialchars($review["comment"]) ?> 
                            (Note : <?= $review["rating"] ?>/5)
                        </p>

                        <?php if ($review["user_id"] == $_SESSION["user_id"]): ?>
                            <!-- Formulaire de mise à jour ou suppression de l'avis -->
                            <form action="../controllers/ReviewController.php" method="POST">
                                <input type="hidden" name="movie_id" value="<?= $movieId ?>">
                                <input type="hidden" name="review_id" value="<?= $review["id"] ?>">
                                <textarea name="comment"><?= htmlspecialchars($review["comment"]) ?></textarea>
                                <input type="number" name="rating" value="<?= $review["rating"] ?>" min="1" max="5">
                                <button type="submit" name="action" value="update">Mettre à jour l'avis</button>
                            </form>
                            <form action="../controllers/ReviewController.php" method="POST">
                                <input type="hidden" name="movie_id" value="<?= $movieId ?>">
                                <input type="hidden" name="review_id" value="<?= $review["id"] ?>">
                                <button type="submit" name="action" value="delete">Supprimer l'avis</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Formulaire d'ajout d'un avis -->
            <?php if (!Review::hasReviewed($_SESSION["user_id"], $movieId)): ?>
                <form action="../controllers/ReviewController.php" method="POST">
                    <input type="hidden" name="movie_id" value="<?= $movieId ?>">
                    <textarea name="comment" placeholder="Laissez un avis..."></textarea>
                    <input type="number" name="rating" min="1" max="5" placeholder="Note (1-5)">
                    <button type="submit" name="action" value="add">Ajouter un avis</button>
                </form>
            <?php else: ?>
                <p>Vous avez déjà laissé un avis pour ce film.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
