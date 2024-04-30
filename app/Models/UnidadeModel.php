<?php
namespace App\Models;
use CodeIgniter\Model;

class UnidadeModel extends Model{

    protected $table = 'unidade';
    protected $primaryKey = 'CODUNIDADE';
    protected $allowedFields = ['TIPO'];

    public function getUnidade(){
        return $this->findAll();
    }
}