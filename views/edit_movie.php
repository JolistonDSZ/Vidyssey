<?php
require_once "../models/Movie.php";
require_once "../controllers/edit_movie.php";
?>
<h2>Modifier le film</h2>
<form action="edit_movie.php?id=<?php echo $movie['id']; ?>" method="POST">
    <label for="title">Titre:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required><?php echo htmlspecialchars($movie['description']); ?></textarea><br>

    <label for="release_year">Année de sortie:</label>
    <input type="number" name="release_year" value="<?php echo $movie['release_year']; ?>" required><br>

    <button type="submit">Modifier le film</button>
</form>

