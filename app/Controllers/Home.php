<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'titulo' => 'CE Controle de Estoque 2'
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/home');
        echo view('/templates/footer');
    }
}
