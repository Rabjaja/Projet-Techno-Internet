CREATE TABLE vinyles (
    id INT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    prix DECIMAL(10, 2) NOT NULL,
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES categories(id)
);
