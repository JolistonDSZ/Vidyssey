<?php
require_once "config.php";

class Review {
    // Ajouter un avis
    public static function addReview($userId, $movieId, $rating, $comment) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO reviews (user_id, movie_id, rating, comment) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$userId, $movieId, $rating, $comment]);
    }

    // Mettre à jour un avis
    public static function updateReview($reviewId, $comment, $rating) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE reviews SET comment = ?, rating = ? WHERE id = ?");
        return $stmt->execute([$comment, $rating, $reviewId]);
    }

    // Supprimer un avis
    public static function deleteReview($reviewId) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = ?");
        return $stmt->execute([$reviewId]);
    }

    // Récupérer l'avis d'un utilisateur pour un film
    public static function getReviewByUserAndMovie($userId, $movieId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM reviews WHERE user_id = ? AND movie_id = ?");
        $stmt->execute([$userId, $movieId]);
        return $stmt->fetch();
    }

    // Récupérer tous les avis pour un film
    public static function getReviews($movieId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT reviews.*, users.username FROM reviews 
                               JOIN users ON reviews.user_id = users.id 
                               WHERE reviews.movie_id = ?");
        $stmt->execute([$movieId]);
        return $stmt->fetchAll();
    }
}
?>
