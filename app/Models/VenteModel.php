<?php

namespace App\Models;

use CodeIgniter\Model;

class VenteModel extends Model
{
    protected $table      = 'vente';
    protected $primaryKey = 'id_vente';
    protected $returnType = 'object';

    protected $allowedFields = ['id_caisse', 'total', 'date_vente'];
}
