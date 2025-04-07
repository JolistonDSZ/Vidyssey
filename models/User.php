<?php
require_once "config.php";

class User {
    public static function register($username, $password, $role = 'user') {
        global $pdo;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $role]);
    }

    public static function login($username, $password) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user["password"])) {
            return $user; // Si le mot de passe est valide, retourne l'utilisateur
        }
        return false; // Si le mot de passe n'est pas valide, retourne false
    }

    // Cette méthode retourne le rôle d'un utilisateur
    public static function getRole($userId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        return $user ? $user["role"] : null;
    }

    public static function getUserById($userId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(); // Retourne toutes les informations de l'utilisateur
    }

    public static function getUserByUsername($username) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(); // Si l'utilisateur existe, retourne ses informations
    }
    
    
}
?>
