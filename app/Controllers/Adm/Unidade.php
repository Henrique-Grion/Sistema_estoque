<?php
namespace App\Controllers\Adm;
use App\Controllers\BaseController;
use App\Models\UnidadeModel;

class Unidade extends BaseController{

    public function index(){
        $model = new UnidadeModel();
        $data = [
            'titulo'    => 'Cadastro de Unidade',
            'unidade'   => $model->getUnidade()
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/unidade');
        echo view('/templates/footer'); 
    }

    public function adicionar(){
        $model = new UnidadeModel();
        $tipo = $this->request->getVar('tipo');
        $model->save([
            'TIPO'  => $tipo
        ]);

        return redirect()->back();
    }

    public function excluir($id=null){
        $model = new UnidadeModel();

        $model->where('CODUNIDADE',$id)->delete();
        
        return redirect()->back();
    }
}