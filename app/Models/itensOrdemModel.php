<?php
namespace App\Models;
use CodeIgniter\Model;

class itensOrdemModel extends Model{

    //Atributos de Configuração
    protected $table = 'item_ordem';
    protected $primaryKey = 'CODITEMORDEM';
    protected $allowedFields = ['CODPRODUTO','QUANTIDADE','VALORUNIT','DESCRICAO','CODORDEM'];

    //Metdodo GET
    public function getItem($id=null){
            return $this->select(
                'item_ordem.CODPRODUTO,
                item_ordem.QUANTIDADE,
                item_ordem.VALORUNIT,
                item_ordem.DESCRICAO,
                item_ordem.CODORDEM,
                item_ordem.CODITEMORDEM,
                produto.NOME')
            ->join('produto','produto.CODPRODUTO = item_ordem.CODPRODUTO')
            ->where(['CODORDEM' => $id])
            ->findAll();            
    }
}