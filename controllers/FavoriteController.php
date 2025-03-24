<?php
session_start();
require_once "../models/Favorite.php";

if (!isset($_SESSION["user_id"])) {
    die("Vous devez être connecté pour gérer vos favoris.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["movie_id"])) {
    $userId = $_SESSION["user_id"];
    $movieId = $_POST["movie_id"];

    // Vérifier l'action effectuée (ajouter ou retirer)
    if ($_POST["action"] === "add") {
        // Ajouter aux favoris si ce n'est pas déjà fait
        if (!Favorite::isFavorite($userId, $movieId)) {
            Favorite::addFavorite($userId, $movieId);
        }
    } elseif ($_POST["action"] === "remove") {
        // Retirer du favori
        Favorite::removeFavorite($userId, $movieId);
    }

    // Rediriger vers la page d'accueil après modification
    header("Location: ../views/home.php");
    exit;
}
