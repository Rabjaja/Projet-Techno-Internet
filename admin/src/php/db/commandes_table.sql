CREATE TABLE commandes (
                           id SERIAL PRIMARY KEY,
                           user_id INT NOT NULL,           -- L'ID de l'utilisateur qui passe la commande
                           date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Date de la commande
                           status VARCHAR(50) DEFAULT 'en attente',  -- Le statut de la commande
                           FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE  -- Lien vers la table users
);

