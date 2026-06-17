<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table      = 'utilisateur';
    protected $primaryKey = 'id';
    protected $returnType = 'object';

    protected $allowedFields = ['nom_utilisateur', 'mot_de_passe'];
}
