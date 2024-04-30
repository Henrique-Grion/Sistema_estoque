<?php
namespace App\Controllers\Adm;
use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\UnidadeModel;
use App\Models\ProdutoModel;

class Produto extends BaseController{

            public function index(){
                $model = new ProdutoModel();
                $model2 = new CategoriaModel();
                $model3 = new UnidadeModel();

                $data = [
                    'titulo'    => 'Cadastro de Produto',
                    'produto'  => $model->getProduto(),
                    'unidade'   => $model3->getUnidade(),
                    'categoria' => $model2->getCat()
                ];
                echo view('/templates/header-html', $data);
                echo view('/templates/header');
                echo view('/pages/produto');
                echo view('/templates/footer'); 
            }

            public function adicionar(){
                $model = new ProdutoModel();

                $unidade = $this->request->getVar('unidade');
                $categoria = $this->request->getVar('categoria');
                $nome = $this->request->getVar('nome');
                $marca = $this->request->getVar('marca');

                $model->save([
                    'CODUNIDADE'    => $unidade,
                    'CODCATEGORIA'  => $categoria,
                    'NOME'          => $nome,
                    'MARCA'         => $marca
                ]);

                return redirect()->back();
            }

            public function excluir($id=null){
                $model = new ProdutoModel();

                $model->where('CODPRODUTO',$id)->delete();
                return redirect()->back();
            }

            public function editar($id=null){

                $model = new ProdutoModel();
                
                $categoria = $this->request->getVar('categoria');
                $unidade = $this->request->getVar('unidade');
                $nome = $this->request->getVar('nome');
                $marca = $this->request->getVar('marca');

                $model->save([
                    'CODPRODUTO'    => $id,
                    'CODUNIDADE'    => $unidade,
                    'CODCATEGORIA'  => $categoria,
                    'NOME'          => $nome,
                    'MARCA'         => $marca
                ]);
                return redirect()->back();
            }
}