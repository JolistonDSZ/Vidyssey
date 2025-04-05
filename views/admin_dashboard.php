<?php
session_start();

// Vérifier si l'utilisateur est connecté et si c'est un administrateur
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../views/login.php"); // Rediriger vers la page de connexion si ce n'est pas un admin
    exit;
}


// Inclure le modèle
require_once "../models/Movie.php";

// Récupérer tous les films
$movies = Movie::getAllMovies();
?>
<?php include "navbar.php"; ?>

<h2>Tableau de bord Admin</h2>

<h3>Liste des films</h3>
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Année de sortie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movies as $movie): ?>
        <tr>
            <td><?php echo htmlspecialchars($movie['title']); ?></td>
            <td><?php echo htmlspecialchars($movie['description']); ?></td>
            <td><?php echo $movie['release_year']; ?></td>
            <td>
                <!-- Lien pour modifier -->
                <a href="edit_movie.php?id=<?php echo $movie['id']; ?>">Modifier</a> |
                <!-- Lien pour supprimer -->
                <a href="../controllers/delete_movie.php?id=<?php echo $movie['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Ajouter un nouveau film</h3>
<form action="../controllers/add_movie.php" method="POST">
    <label for="title">Titre:</label>
    <input type="text" name="title" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br>

    <label for="release_year">Année de sortie:</label>
    <input type="number" name="release_year" required><br>

    <button type="submit">Ajouter le film</button>
</form>

