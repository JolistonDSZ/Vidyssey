<?php
require_once "../models/movie.php";

// Récupérer l'ID du film
$id = $_GET['id'] ?? null;
if ($id) {
    // Supprimer le film
    if (Movie::deleteMovie($id)) {
        echo "Le film a été supprimé avec succès!";
    } else {
        echo "Erreur lors de la suppression du film.";
    }
} else {
    echo "Aucun film trouvé à supprimer.";
}

header("Location: ../views/admin_dashboard.php"); // Rediriger vers le tableau de bord admin après suppression
exit;
?>
