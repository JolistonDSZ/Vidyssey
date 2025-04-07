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
     if (isset($_POST["login"])) {
         $username = $_POST["username"];
         $password = $_POST["password"];
         
         // Appelle la méthode de login dans User.php
         $user = User::login($username, $password);
         
         if ($user) {
             // Connexion réussie, enregistrer les données en session
             $_SESSION["user_id"] = $user["id"];
             $_SESSION["role"] = $user["role"];
             // Redirection en fonction du rôle
             if ($user["role"] === "admin") {
                 header("Location: ../views/admin_dashboard.php"); // Dashboard admin
             } else {
                 header("Location: ../views/home.php"); // Dashboard utilisateur
             }
         } else {
             echo "Identifiants incorrects";
             echo "Identifiants incorrects"; // Le mot de passe est incorrect ou l'utilisateur n'existe pas
         }
     }}}
 }
 ?>