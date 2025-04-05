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
    release_year INT,
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

CREATE TABLE watchlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    movie_id INT,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
);


-- Modifier la table movies pour ajouter une colonne image_filename
-- ALTER TABLE movies ADD COLUMN image_filename VARCHAR(255);

-- Insérer des films avec le nom des fichiers image
INSERT INTO movies (title, description, release_year)
VALUES
    ("Inception", "Un voleur qui pénètre dans le subconscient des gens pour voler des secrets.", 2010),
    ("The Shawshank Redemption", "Deux hommes se lient d’amitié dans une prison et trouvent la rédemption.", 1994),
    ("The Godfather", "L’histoire de la famille mafieuse Corleone et de son patriarche, Vito Corleone.", 1972),
    ("Pulp Fiction", "Un film à sketches qui entrecroise plusieurs histoires de criminels à Los Angeles.", 1994),
    ("Forrest Gump", "La vie extraordinaire d’un homme simple qui traverse les événements majeurs du XXe siècle.", 1994),
    ("The Lord of the Rings: The Fellowship of the Ring", "Un hobbit et ses amis partent en quête pour détruire un anneau maléfique.", 2001),
    ("Fight Club", "Un homme désillusionné crée un club de combat clandestin pour échapper à sa vie monotone.", 1999),
    ("The Social Network", "L’histoire de la création de Facebook et des conflits qui en ont découlé.", 2010),
    ("Gladiator", "Un général romain trahi devient gladiateur pour venger sa famille.", 2000),
    ("The Silence of the Lambs", "Une jeune agente du FBI consulte un tueur en série pour capturer un autre tueur.", 1991),
    ("Schindler’s List", "L’histoire vraie d’Oskar Schindler, qui a sauvé des Juifs pendant l’Holocauste.", 1993),
    ("The Dark Knight Rises", "Huit ans après les événements de Gotham, Batman doit faire face à un nouveau méchant, Bane.", 2012),
    ("The Avengers", "Un groupe de super-héros s’unit pour combattre une menace extraterrestre.", 2012),
    ("Avatar", "Un ancien marine est envoyé sur une lune extraterrestre et se retrouve impliqué dans un conflit.", 2009),
    ("Jurassic Park", "Des scientifiques créent un parc à thème avec des dinosaures clonés, mais tout ne se passe pas comme prévu.", 1993),
    ("Star Wars: Episode IV - A New Hope", "Un jeune fermier rejoint une rébellion pour combattre un empire maléfique.", 1977),
    ("The Lion King", "Un jeune lion doit retrouver son trône après la mort de son père.", 1994),
    ("Harry Potter and the Sorcerer’s Stone", "Un jeune garçon découvre qu’il est un sorcier et entre dans une école de magie.", 2001),
    ("The Wizard of Oz", "Une jeune fille est transportée dans un monde magique et doit trouver son chemin pour rentrer chez elle.", 1939),
    ("Back to the Future", "Un adolescent voyage dans le temps pour s’assurer que ses parents se rencontrent.", 1985),
    ("The Dark Knight", "Batman combat le Joker, un criminel qui veut plonger Gotham dans le chaos.", 2008),
    ("Interstellar", "Un groupe d’astronautes voyage à travers un trou de ver pour trouver une nouvelle planète habitable.", 2014),
    ("The Matrix", "Un programmeur découvre que la réalité dans laquelle il vit est en fait une simulation informatique.", 1999),
    ("Titanic", "Un passager de première classe et une jeune fille se retrouvent sur le bateau de luxe, Titanic, avant qu’il ne sombre.", 1997),
    ("The Menu", "Un film de cuisine", 1997);



INSERT INTO users (username, password, role) 
VALUES ('ego', '$2y$10$DppDo6IYTjJ4XHjP/dTIPuZYs58r34L5NxlkAJwG7kvuOFr2I4yp2', 'admin'); -- mot de passe : admin