<?php
require_once "config.php";

class Movie {
    // Récupérer tous les films
    public static function getAllMovies() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, title, description, release_year FROM movies");
        return $stmt->fetchAll();
    }
    

    // Ajouter un film
    public static function addMovie($title, $description, $release_year) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO movies (title, description, release_year) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $description, $release_year]);
    }

    // Obtenir un film par son ID
    public static function getMovieById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Modifier un film
public static function updateMovie($id, $title, $description, $release_year) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE movies SET title = ?, description = ?, release_year = ? WHERE id = ?");
    return $stmt->execute([$title, $description, $release_year, $id]);
}

// Supprimer un film
public static function deleteMovie($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM movies WHERE id = ?");
    return $stmt->execute([$id]);
}

}
?>
