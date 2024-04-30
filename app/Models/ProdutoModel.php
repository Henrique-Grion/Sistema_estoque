<?php
namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model{

    protected $table = 'produto';
    protected $primaryKey = 'CODPRODUTO';
    protected $allowedFields = ['CODCATEGORIA','CODUNIDADE','NOME','MARCA'];

    public function getProduto(){
        return $this->findAll();
    }
}