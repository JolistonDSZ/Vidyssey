<?php
require_once "../models/Movie.php";

// Récupérer l'ID du film
$id = $_GET['id'] ?? null;
if ($id) {
    $movie = Movie::getMovieById($id);
} else {
    echo "Aucun film trouvé.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];

    // Mettre à jour le film
    if (Movie::updateMovie($id, $title, $description, $release_year)) {
        echo "Le film a été modifié avec succès!";
        header("Location: ../views/admin_dashboard.php"); 
    } else {
        echo "Erreur lors de la modification du film.";
    }
}
?>

