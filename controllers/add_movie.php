<?php
require_once "../models/Movie.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];

    // Appeler la méthode pour ajouter un film
    if (Movie::addMovie($title, $description, $release_year)) {
        echo "Le film a été ajouté avec succès!";
        header("Location: ../views/admin_dashboard.php"); // Rediriger vers le tableau de bord admin après ajout
    } else {
        echo "Erreur lors de l'ajout du film.";
    }
}
?>
