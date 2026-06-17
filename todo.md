# Todo — Supermarket

## Fait

### 1. Écran d'accueil (choix de la caisse)
- Page d'accueil avec dropdown listant les caisses depuis la DB
- Bouton Valider → stocke le choix en session → redirige vers saisie des achats
- Page dédiée `/choisir-caisse` accessible via le menu

### 2. Saisie des achats
- Formulaire : dropdown produit (depuis DB) + quantité + bouton Valider
- Tableau récapitulatif : Produit, Prix unit., Qté, Montant
- Total calculé dynamiquement
- Page accessible sans caisse (message + bouton pour en choisir une)

### 3. Base de données
- Tables : `utilisateur`, `caisse`, `produit`, `vente`, `achat`
- Données de test : 2 caisses, 5 produits, 1 utilisateur (admin/password)
- `clean.sql` pour réinitialiser les tables

### 4. Authentification
- Écran de login avant toute page
- Utilisateur par défaut : `admin` / `password`
- Œil pour afficher/masquer le mot de passe
- Déconnexion fonctionnelle

### 5. Stock
- `quantite_stock` décrémentée à chaque achat
- Vérification du stock avant validation
- Message d'erreur si stock insuffisant

### 6. Clôture d'achat
- Bouton "Clôturer achat" quand des achats sont en cours
- Crée une vente (regroupement par client)
- Lie les achats à la vente
- Liste vidée pour le prochain client

### 7. Historique
- Page listant toutes les ventes clôturées par caisse
- Détail des produits et total par vente

### 8. Navigation
- Sidebar avec tous les liens fonctionnels (Accueil, Choisir caisse, Saisie, Produits, Historique)
- Lien Déconnexion
- Lien actif surligné

### 9. Divers
- Template header/footer extrait de `template.html`
- Session activée dans BaseController
- Routes CI4 configurées
- Affichage en Ariary (Ar)

## À faire
- 
