<?php
require_once "config.php";

class Watchlist {
    // Ajouter un film à la Watchlist
    public static function addToWatchlist($userId, $movieId) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO watchlist (user_id, movie_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $movieId]);
    }

    // Retirer un film de la Watchlist
    public static function removeFromWatchlist($userId, $movieId) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM watchlist WHERE user_id = ? AND movie_id = ?");
        return $stmt->execute([$userId, $movieId]);
    }

    // Vérifier si un film est dans la Watchlist
    public static function isInWatchlist($userId, $movieId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM watchlist WHERE user_id = ? AND movie_id = ?");
        $stmt->execute([$userId, $movieId]);
        return $stmt->fetch() ? true : false;
    }

    // Récupérer les films de la Watchlist d'un utilisateur
    public static function getWatchlist($userId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT movies.* FROM watchlist 
                               JOIN movies ON watchlist.movie_id = movies.id 
                               WHERE watchlist.user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
?>
