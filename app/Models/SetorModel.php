<?php
namespace App\Models;
use CodeIgniter\Model;

class SetorModel extends Model{

    protected $table = 'setor';
    protected $primaryKey = 'CODSETOR';
    protected $allowedFields = ['NOME'];

    public function getSetor(){
        return $this->findAll();
    }
}