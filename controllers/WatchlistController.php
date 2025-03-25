<?php
session_start();
require_once "../models/Watchlist.php";

if (!isset($_SESSION["user_id"])) {
    die("Vous devez être connecté pour gérer votre Watchlist.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["movie_id"])) {
    $userId = $_SESSION["user_id"];
    $movieId = $_POST["movie_id"];

    if (isset($_POST["action"])) {
        if ($_POST["action"] === "add") {
            if (!Watchlist::isInWatchlist($userId, $movieId)) {
                Watchlist::addToWatchlist($userId, $movieId);
            }
        } elseif ($_POST["action"] === "remove") {
            Watchlist::removeFromWatchlist($userId, $movieId);
        }
    }

    header("Location: ../views/dashboard.php");
    exit;
}
?>
