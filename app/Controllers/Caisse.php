<?php

namespace App\Controllers;

use App\Models\CaisseModel;
use App\Models\ProduitModel;
use App\Models\AchatModel;
use App\Models\VenteModel;

class Caisse extends BaseController
{
    private function checkAuth()
    {
        if (!$this->session->get('utilisateur')) {
            return redirect()->to('/login');
        }
        return null;
    }

    private function loadCaisses()
    {
        $model = new CaisseModel();
        return $model->findAll();
    }

    private function getIdCaisseByNumero($numero)
    {
        $db = db_connect();
        $row = $db->query('SELECT id_caisse FROM caisse WHERE numero = ?', [$numero])->getRow();
        return $row ? $row->id_caisse : null;
    }

    public function index()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('accueil', [
            'pageTitle'    => 'Choisir une caisse',
            'pageSubtitle' => 'Sélectionnez le numéro de caisse pour commencer',
            'activeNav'    => 'accueil',
            'caisse'       => $this->session->get('caisse'),
            'caisses'      => $this->loadCaisses(),
        ]);
    }

    public function choisirPage()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('accueil', [
            'pageTitle'    => 'Choisir une caisse',
            'pageSubtitle' => 'Sélectionnez le numéro de caisse pour commencer',
            'activeNav'    => 'choisir',
            'caisse'       => $this->session->get('caisse'),
            'caisses'      => $this->loadCaisses(),
        ]);
    }

    public function choisir()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $caisse = $this->request->getPost('caisse');
        if ($caisse) {
            $this->session->set('caisse', $caisse);
        }

        return redirect()->to('/saisie-achats');
    }

    public function saisieAchats()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $caisse = $this->session->get('caisse');
        $produitModel = new ProduitModel();
        $produits = $produitModel->findAll();

        $idCaisse = $caisse ? $this->getIdCaisseByNumero($caisse) : null;
        $achats = [];
        $total = 0;

        if ($idCaisse) {
            $db = db_connect();
            $achats = $db->query(
                'SELECT a.id_achat, p.designation, a.prix_unitaire, a.quantite, a.montant
                 FROM achat a
                 JOIN produit p ON a.id_produit = p.id
                 WHERE a.id_caisse = ? AND a.id_vente IS NULL
                 ORDER BY a.id_achat',
                [$idCaisse]
            )->getResult();

            foreach ($achats as $a) {
                $total += $a->montant;
            }
        }

        return view('saisie_achats', [
            'pageTitle'    => 'Saisie des achats',
            'pageSubtitle' => 'Sélectionnez un produit puis validez la quantité',
            'activeNav'    => 'saisie',
            'caisse'       => $caisse,
            'produits'     => $produits,
            'achats'       => $achats,
            'total'        => $total,
        ]);
    }

    public function ajouterAchat()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $caisse = $this->session->get('caisse');
        if (!$caisse) {
            return redirect()->to('/');
        }

        $idProduit = $this->request->getPost('produit');
        $quantite = (int) $this->request->getPost('quantite');

        if (!$idProduit || $quantite < 1) {
            return redirect()->back()->with('error', 'Veuillez sélectionner un produit et saisir une quantité valide.');
        }

        $db = db_connect();

        $produit = $db->query('SELECT id, prix, quantite_stock FROM produit WHERE id = ?', [$idProduit])->getRow();
        if (!$produit) {
            return redirect()->back()->with('error', 'Produit introuvable.');
        }

        if ($produit->quantite_stock < $quantite) {
            return redirect()->back()->with('error', 'Stock insuffisant. Restant : ' . $produit->quantite_stock);
        }

        $idCaisse = $this->getIdCaisseByNumero($caisse);
        if (!$idCaisse) {
            return redirect()->back()->with('error', 'Caisse introuvable.');
        }

        $prixUnitaire = $produit->prix;
        $montant = $quantite * $prixUnitaire;

        $db->query('UPDATE produit SET quantite_stock = quantite_stock - ? WHERE id = ?', [$quantite, $idProduit]);

        $achatModel = new AchatModel();
        $achatModel->insert([
            'id_produit'    => $idProduit,
            'id_caisse'     => $idCaisse,
            'quantite'      => $quantite,
            'prix_unitaire' => $prixUnitaire,
            'montant'       => $montant,
        ]);

        return redirect()->to('/saisie-achats');
    }

    public function cloturer()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $caisse = $this->session->get('caisse');
        if (!$caisse) {
            return redirect()->to('/');
        }

        $db = db_connect();
        $idCaisse = $this->getIdCaisseByNumero($caisse);

        if (!$idCaisse) {
            return redirect()->back()->with('error', 'Caisse introuvable.');
        }

        $pending = $db->query(
            'SELECT SUM(montant) AS total FROM achat WHERE id_caisse = ? AND id_vente IS NULL',
            [$idCaisse]
        )->getRow();

        if (!$pending->total) {
            return redirect()->to('/saisie-achats');
        }

        $venteModel = new VenteModel();
        $venteModel->insert([
            'id_caisse' => $idCaisse,
            'total'     => $pending->total,
        ]);

        $idVente = $venteModel->insertID();

        $db->query(
            'UPDATE achat SET id_vente = ? WHERE id_caisse = ? AND id_vente IS NULL',
            [$idVente, $idCaisse]
        );

        return redirect()->to('/saisie-achats');
    }

    public function produits()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $caisse = $this->session->get('caisse');
        $produitModel = new ProduitModel();
        $produits = $produitModel->findAll();

        return view('produits', [
            'pageTitle'    => 'Produits',
            'pageSubtitle' => 'Liste des produits disponibles',
            'activeNav'    => 'produits',
            'caisse'       => $caisse,
            'produits'     => $produits,
        ]);
    }

    public function historique()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $caisse = $this->session->get('caisse');

        $ventes = [];

        if ($caisse) {
            $db = db_connect();
            $idCaisse = $this->getIdCaisseByNumero($caisse);

            $ventes = $db->query(
                'SELECT v.id_vente, v.total, v.date_vente
                 FROM vente v
                 WHERE v.id_caisse = ?
                 ORDER BY v.date_vente DESC',
                [$idCaisse]
            )->getResult();

            foreach ($ventes as $v) {
                $v->achats = $db->query(
                    'SELECT p.designation, a.quantite, a.prix_unitaire, a.montant
                     FROM achat a
                     JOIN produit p ON a.id_produit = p.id
                     WHERE a.id_vente = ?',
                    [$v->id_vente]
                )->getResult();
            }
        }

        return view('historique', [
            'pageTitle'    => 'Historique',
            'pageSubtitle' => 'Achats clôturés pour cette caisse',
            'activeNav'    => 'historique',
            'caisse'       => $caisse,
            'ventes'       => $ventes,
        ]);
    }
}
