<?php
namespace App\Models;
use CodeIgniter\Model;

class OrdemModel extends Model{

    //Atributos de Configuração
    protected $table = 'ordem';
    protected $primaryKey = 'CODORDEM';
    protected $allowedFields = ['SITUACAO','VALOR','DATA'];

    //Metdodo GET
    public function getOrdem($id = null){
        if($id == null){
            return $this->findAll();
        }else{
            return $this->asArray()
                        ->where(['CODORDEM' => $id])
                        ->first();
        }
            
    }
}