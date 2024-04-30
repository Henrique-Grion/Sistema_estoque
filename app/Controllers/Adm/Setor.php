<?php
namespace App\Controllers\Adm;
use App\Controllers\BaseController;
use App\Models\SetorModel;

class Setor extends BaseController{

    public function index(){
        $model = new SetorModel();
        $data = [
            'titulo'    => 'Cadastro de Setores',
            'setor'     => $model->getSetor()
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/setor');
        echo view('/templates/footer'); 
    }

    public function adicionar(){
        $model = new SetorModel();
        
        $nome = $this->request->getVar('nome');

        $model->save([
            'NOME' => $nome
        ]);

        return redirect()->back();
    }

    public function excluir($id=null){
        $model = new SetorModel();

        $model->where('CODSETOR',$id)->delete();
        return redirect()->back();
    }
}