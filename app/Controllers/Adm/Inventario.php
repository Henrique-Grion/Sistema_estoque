<?php
namespace App\Controllers\Adm;
use App\Controllers\BaseController;
use App\Models\InventarioModel;
use App\Models\ProdutoModel;
use App\Models\EstoqueModel;

class Inventario extends BaseController{

    public function index(){
        $model = new InventarioModel();
        $model2 = new ProdutoModel();

        $data = [
            'titulo'     => 'Inventario',
            'inventario' => $model->getInventario(),
            'produto'    => $model2->getProduto()
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/inventario');
        echo view('/templates/footer'); 
    }

    public function adicionar(){
        $model = new InventarioModel();

        $produto = $this->request->getVar('produto');
        $quantidade = $this->request->getVar('qtd');

        $model->save([
            'CODPRODUTO'    => $produto,
            'QUANTIDADE'    => $quantidade
        ]);

        return redirect()->back();
    }

    public function excluir($id=null){
        $model = new InventarioModel();

        $model->where('CODINVENTARIO',$id)->delete();

        return redirect()->back();
    }

    public function editar($id=null){
        $model =new InventarioModel();

        $qtd = $this->request->getVar('qtd');

        $model->save([
            'CODINVENTARIO'     => $id,
            'QUANTIDADE'        => $qtd
        ]);

        return redirect()->back();
    }

    public function salvar(){
        $model = new InventarioModel();
        $model2 = new EstoqueModel();

        $valida=0;
        $estoque = $model2->getEstoque();
        $inventario = $model->getInventario();

        foreach($inventario as $item_i){
            $i=0;
            $valida=0;
            do{

                if($item_i['CODPRODUTO'] == $estoque[$i]['CODPRODUTO']){
                    $soma=$estoque[$i]['QUANTIDADE'] + $item_i['QUANTIDADE'];
                    $model2->save([
                        'CODESTOQUE'    => $estoque[$i]['CODESTOQUE'],
                        'CODPRODUTO'    => $estoque[$i]['CODPRODUTO'],
                        'QUANTIDADE'    => $soma
                    ]);
                    $valida=44;
                }
                $i++;
            }while($i<count($estoque));

            if($valida==0){
                $model2->save([
                    'CODPRODUTO'    => $item_i['CODPRODUTO'],
                    'QUANTIDADE'    => $item_i['QUANTIDADE']
                ]);
            }
        }
        $model->where('CODINVENTARIO > 1')->delete();

        return redirect()->back();
    }
}