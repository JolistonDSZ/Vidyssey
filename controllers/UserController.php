<?php
session_start();
require_once "../models/User.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["register"])) {
        User::register($_POST["username"], $_POST["password"]);
        header("Location: ../views/login.php");
    } elseif (isset($_POST["login"])) {
        $userId = User::login($_POST["username"], $_POST["password"]);
        if ($userId) {
            $_SESSION["user_id"] = $userId;
            header("Location: ../views/home.php");
        } else {
            echo "Identifiants incorrects";
        }
    }
}
?>
