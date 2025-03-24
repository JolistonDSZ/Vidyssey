<?php
session_start();
require_once "../models/Review.php";

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    die("Vous devez être connecté pour gérer vos avis.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_SESSION["user_id"];
    $movieId = $_POST["movie_id"];
    $action = $_POST["action"];

    if ($action === "add") {
        // Ajouter un nouvel avis
        $comment = $_POST["comment"];
        $rating = $_POST["rating"];

        // Ajouter l'avis à la base de données
        Review::addReview($userId, $movieId, $rating, $comment);
    } elseif ($action === "update") {
        // Mettre à jour un avis existant
        $reviewId = $_POST["review_id"];
        $comment = $_POST["comment"];
        $rating = $_POST["rating"];

        // Mettre à jour l'avis dans la base de données
        Review::updateReview($reviewId, $comment, $rating);
    } elseif ($action === "delete") {
        // Supprimer l'avis
        $reviewId = $_POST["review_id"];
        Review::deleteReview($reviewId);
    }

    // Redirection vers le dashboard
    header("Location: ../views/dashboard.php");
    exit;
}
