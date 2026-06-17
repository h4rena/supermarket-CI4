PRAGMA foreign_keys = OFF;

DROP TABLE IF EXISTS achat;
DROP TABLE IF EXISTS vente;
DROP TABLE IF EXISTS caisse;
DROP TABLE IF EXISTS produit;
DROP TABLE IF EXISTS utilisateur;

PRAGMA foreign_keys = ON;

CREATE TABLE utilisateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_utilisateur VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL
);

CREATE TABLE produit(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    designation VARCHAR(255),
    prix DECIMAL(10, 2),
    quantite_stock INTEGER
);

CREATE TABLE caisse (
    id_caisse INTEGER PRIMARY KEY AUTOINCREMENT,
    numero INTEGER
);

CREATE TABLE vente (
    id_vente INTEGER PRIMARY KEY AUTOINCREMENT,
    id_caisse INTEGER,
    total NUMERIC NOT NULL DEFAULT 0,
    date_vente DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_caisse) REFERENCES caisse(id_caisse)
);

CREATE TABLE achat (
    id_achat INTEGER PRIMARY KEY AUTOINCREMENT,
    id_produit INTEGER,
    id_caisse INTEGER,
    id_vente INTEGER,
    quantite INTEGER NOT NULL,
    prix_unitaire NUMERIC NOT NULL,
    montant NUMERIC,
    FOREIGN KEY (id_produit) REFERENCES produit(id),
    FOREIGN KEY (id_caisse) REFERENCES caisse(id_caisse),
    FOREIGN KEY (id_vente) REFERENCES vente(id_vente)
);

INSERT INTO utilisateur (nom_utilisateur, mot_de_passe) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO caisse (numero) VALUES (1), (2);

INSERT INTO produit (designation, prix, quantite_stock) VALUES
('Biscuit', 1000, 50),
('Pain', 400, 30),
('Lait', 1200, 20),
('Riz', 2500, 15),
('Huile', 3000, 10);
