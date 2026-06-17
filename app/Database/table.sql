PRAGMA foreign_keys = ON;

CREATE TABLE produit(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    designation VARCHAR(255) ,
    prix DECIMAL(10, 2) ,
    quantite_stock INTEGER 
);

CREATE TABLE caisse (
    id_caisse INTEGER PRIMARY KEY AUTOINCREMENT,
    numero TEXT
);

CREATE TABLE achat (
    id_achat INTEGER PRIMARY KEY AUTOINCREMENT,
    id_produit INTEGER,
    id_caisse INTEGER,
    quantite INTEGER NOT NULL,
    prix_unitaire NUMERIC NOT NULL,
    montant NUMERIC,
    FOREIGN KEY (id_produit) REFERENCES produit(id_produit),
    FOREIGN KEY (id_caisse) REFERENCES caisse(id_caisse)
);