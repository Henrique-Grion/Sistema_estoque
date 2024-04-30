<?php
namespace App\Models;
use CodeIgniter\Model;

class itenSaidaModel extends Model{

    //Atributos de Configuração
    protected $table = 'item_saida';
    protected $primaryKey = 'CODITEMSAIDA';
    protected $allowedFields = ['CODSETOR','CODPRODUTO','QUANTIDADE','CODSAIDA'];

    //Metdodo GET
    public function getItem($id=null){
            return $this->select(
                'item_saida.CODPRODUTO,
                item_saida.QUANTIDADE,
                item_saida.CODITEMSAIDA,
                item_saida.CODSAIDA,
                produto.NOME AS PRODUTO,
                setor.NOME AS SETOR')
            ->join('produto','produto.CODPRODUTO = item_saida.CODPRODUTO')
            ->join('setor','setor.CODSETOR = item_saida.CODSETOR')
            ->where(['CODSAIDA' => $id])
            ->findAll();            
    }
}