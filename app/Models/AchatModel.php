<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table      = 'achat';
    protected $primaryKey = 'id_achat';
    protected $returnType = 'object';

    protected $allowedFields = ['id_produit', 'id_caisse', 'quantite', 'prix_unitaire', 'montant'];
}
