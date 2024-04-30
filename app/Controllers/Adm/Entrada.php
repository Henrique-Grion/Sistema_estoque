<?php
namespace App\Controllers\Adm;

use App\Controllers\BaseController;
use App\Models\EntradaModel;

class Entrada extends BaseController{

    public function index(){
        $data =[
            'titulo' => 'Entradas'
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/entrada');
        echo view('/templates/footer');
    }

    public function buscar(){
        $model = new EntradaModel();
    
        $de = $this->request->getVar('de').' 00:00:00';
        $ate = $this->request->getVar('ate').' 23:59:59';

        $data = [
            'titulo'    => 'Entradas',
            'entrada'   => $model->getEntrada($de,$ate)
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/entrada');
        echo view('/templates/footer');
    }
}