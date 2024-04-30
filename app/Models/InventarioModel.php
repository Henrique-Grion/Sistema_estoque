<?php
namespace App\Models;
use CodeIgniter\Model;

class InventarioModel extends Model{

    protected $table = 'inventario';
    protected $primaryKey = 'CODINVENTARIO';
    protected $allowedFields = ['CODPRODUTO','QUANTIDADE'];

    public function getInventario(){
        return $this->select('
                    inventario.CODPRODUTO,
                    inventario.QUANTIDADE,
                    inventario.CODINVENTARIO,
                    unidade.TIPO,
                    produto.NOME')
                    ->join('produto','produto.CODPRODUTO = inventario.CODPRODUTO')
                    ->join('unidade','unidade.CODUNIDADE = produto.CODUNIDADE')
                    ->findAll();
    }
}