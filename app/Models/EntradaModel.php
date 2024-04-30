<?php
namespace App\Models;
use CodeIgniter\Model;

class EntradaModel extends Model{

    //Atributos de Configuração
    protected $table = 'entrada';
    protected $primaryKey = 'CODENTRADA';
    protected $allowedFields = ['CODORDEM','DATA'];

    //Metdodo GET
    public function getEntrada($de=null,$ate=null){
            return $this->where('DATA >= ',$de)
                        ->where('DATA <=',$ate)
                        ->findAll();
    }
}