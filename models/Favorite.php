<?php
require_once "config.php";

class Favorite {
    // Ajouter un film aux favoris
    public static function addFavorite($userId, $movieId) {
        global $pdo;
        // Prépare la requête d'insertion dans la table 'favorites'
        $stmt = $pdo->prepare("INSERT INTO favorites (user_id, movie_id) VALUES (?, ?)");
        // Exécute la requête avec les données
        return $stmt->execute([$userId, $movieId]);
    }
    

    // Retirer un film des favoris
    public static function removeFavorite($userId, $movieId) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND movie_id = ?");
        return $stmt->execute([$userId, $movieId]);
    }
    

    // Vérifier si un film est déjà dans les favoris
    public static function isFavorite($userId, $movieId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM favorites WHERE user_id = ? AND movie_id = ?");
        $stmt->execute([$userId, $movieId]);
        return $stmt->fetch() ? true : false;
    }
    

    // Obtenir les films favoris d'un utilisateur
    public static function getFavorites($userId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT movies.* FROM favorites 
                               JOIN movies ON favorites.movie_id = movies.id 
                               WHERE favorites.user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();  // Récupère tous les films favoris
    }
    
}
?>
