<?php

namespace App\Models;

use CodeIgniter\Model;

class CaisseModel extends Model
{
    protected $table      = 'caisse';
    protected $primaryKey = 'id_caisse';
    protected $returnType = 'object';

    protected $allowedFields = ['numero'];
}
