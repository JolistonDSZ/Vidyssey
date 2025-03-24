<?php
session_start();
session_destroy();
header("Location: ../views/home.php"); // Redirection vers la page d'accueil
exit;
?>
