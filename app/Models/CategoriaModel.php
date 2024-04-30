<?php
namespace App\Models;
use CodeIgniter\Model;

class CategoriaModel extends Model{

    protected $table = 'categoria';
    protected $primaryKey = 'CODCATEGORIA';
    protected $allowedFields = ['NOME'];

    public function getCat(){
        return $this->findAll();
    }
}