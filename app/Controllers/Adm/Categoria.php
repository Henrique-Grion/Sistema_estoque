<?php
namespace App\Controllers\Adm;
use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categoria extends BaseController{

    public function index(){
        $model = new CategoriaModel();
        $data = [
            'titulo'    => 'Cadastro de Setores',
            'categoria'     => $model->getCat()
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/categoria');
        echo view('/templates/footer'); 
    }

    public function adicionar(){
        $model = new CategoriaModel();

        $tipo = $this->request->getVar('nome');

        $model->save([
            'NOME' => $tipo
        ]);

        return redirect()->back();
    }

    public function excluir($id=null){
        $model = new CategoriaModel();

        $model->where('CODCATEGORIA',$id)->delete();
        return redirect()->back();
    }
}