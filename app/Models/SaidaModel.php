<?php
namespace App\Models;
use CodeIgniter\Model;

class SaidaModel extends Model{

    //Atributos de Configuração
    protected $table = 'saida';
    protected $primaryKey = 'CODSAIDA';
    protected $allowedFields = ['DATA','ITENS'];

    //Metdodo GET
    public function getSaida($de=null,$ate=null){
            return $this->where('DATA >= ',$de)
                        ->where('DATA <=',$ate)
                        ->findAll();
    }
}