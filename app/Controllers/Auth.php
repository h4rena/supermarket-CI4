<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->session->get('utilisateur')) {
            return redirect()->to('/');
        }

        return view('login', [
            'pageTitle' => 'Connexion',
            'activeNav' => '',
        ]);
    }

    public function authenticate()
    {
        $nomUtilisateur = $this->request->getPost('nom_utilisateur');
        $motDePasse = $this->request->getPost('mot_de_passe');

        $model = new UtilisateurModel();
        $utilisateur = $model->where('nom_utilisateur', $nomUtilisateur)->first();

        if ($utilisateur && password_verify($motDePasse, $utilisateur->mot_de_passe)) {
            $this->session->set('utilisateur', $utilisateur->nom_utilisateur);
            return redirect()->to('/');
        }

        return redirect()->back()->with('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
    }

    public function logout()
    {
        $this->session->remove('utilisateur');
        return redirect()->to('/login');
    }
}
