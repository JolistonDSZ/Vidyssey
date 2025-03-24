CREATE DATABASE films_db;
USE films_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    release_year INT
);

CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    movie_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    movie_id INT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
);

-- Modifier la table movies pour ajouter une colonne image_filename
ALTER TABLE movies ADD COLUMN image_filename VARCHAR(255);

-- Insérer des films avec le nom des fichiers image
INSERT INTO movies (title, description, release_year, image_filename)
VALUES
    ('Inception', 'Un voleur qui pénètre dans le subconscient des gens pour voler des secrets.', 2010, 'inception.jpg'),
    ('The Dark Knight', 'Batman combat le Joker, un criminel qui veut plonger Gotham dans le chaos.', 2008, 'dark_knight.jpg'),
    ('Interstellar', 'Un groupe dastronautes voyage à travers un trou de ver pour trouver une nouvelle planète habitable.', 2014, 'interstellar.jpg'),
    ('The Matrix', 'Un programmeur découvre que la réalité dans laquelle il vit est en fait une simulation informatique.', 1999, 'the_matrix.jpg'),
    ('Titanic', 'Un passager de première classe et une jeune fille se retrouvent sur le bateau de luxe, Titanic, avant quil ne sombre.', 1997, 'titanic.jpg'),
    ('theMenu', 'un film de cuisine', 1997, 'leMenu.jpg');