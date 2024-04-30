<?php
namespace App\Models;
use CodeIgniter\Model;

class EstoqueModel extends Model{

    //Atributos de Configuração
    protected $table = 'estoque';
    protected $primaryKey = 'CODESTOQUE';
    protected $allowedFields = ['CODPRODUTO','QUANTIDADE'];

    //Metdodo GET
    public function getEstoque(){
            return $this->select('
                                unidade.TIPO, 
                                categoria.NOME AS categoria,
                                produto.NOME AS produto, 
                                produto.MARCA, 
                                estoque.CODPRODUTO,
                                estoque.QUANTIDADE,
                                estoque.CODESTOQUE')
                        ->join('produto','produto.CODPRODUTO = estoque.CODPRODUTO')
                        ->join('unidade','unidade.CODUNIDADE = produto.CODUNIDADE')
                        ->join('categoria','categoria.CODCATEGORIA = produto.CODCATEGORIA')
                        ->findAll();
    }
}