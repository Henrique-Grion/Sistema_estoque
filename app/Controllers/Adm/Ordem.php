<?php

namespace App\Controllers\Adm;

require './../dompdf/vendor/autoload.php';

use App\Controllers\BaseController;
use App\Models\OrdemModel;
use App\Models\itensOrdemModel;
use App\Models\ProdutoModel;
use App\Models\EntradaModel;
use App\Models\EstoqueModel;
use Dompdf\Dompdf;
use CodeIgniter\I18n\Time;


class Ordem extends BaseController
{

    //View das Ordens do sistema
    public function index()
    {

        $model = new OrdemModel();
        $data = [
            'titulo'    => 'Ordem de Compra',
            'ordem'     => $model->getOrdem(),
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/ordem');
        echo view('/templates/footer');
    }

    //Excluir ordem do sistema
    public function excluir($id = null)
    {
        $model = new OrdemModel();
        $model2 = new itensOrdemModel();
        $model2->where('CODORDEM', $id)
            ->delete();
        $model->delete($id);

        return redirect()->to(base_url('ordem'));
    }

    //View dos itens da Ordem
    public function itens($id = null)
    {
        $model = new itensOrdemModel();

        $data = [
            'titulo' => 'Visualizar itens',
            'item'   => $model->getItem($id),
            'id'     => $id
        ];

        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/itemordem');
        echo view('/templates/footer');
    }

    //View para criar ordem
    public function gerar()
    {
        $model = new itensOrdemModel();
        $model2 = new ProdutoModel();

        $data = [
            'titulo' => 'Gerar Ordem de compra',
            'item'   => $model->getItem(),
            'produto' => $model2->getProduto()
        ];

        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/criaordem');
        echo view('/templates/footer');
    }

    // Adiciona item na ordem (id da ordem)
    public function adicionar($id = null)
    {
        $model = new itensOrdemModel();
        $model2 = new ProdutoModel();

        $aux = true;
        $result = $model->getItem($id);

        $produto = $this->request->getVar('produto');
        $quantidade = $this->request->getVar('qtd');
        $valorunit = $this->request->getVar('valor');
        $descricao = $this->request->getVar('descricao');

        foreach ($result as $valida) :
            if ($valida['CODPRODUTO'] == $produto) {
                $aux = false;
            }
        endforeach;
        if ($aux == true) {
            $model->save([
                'CODPRODUTO' => $produto,
                'QUANTIDADE' => $quantidade,
                'VALORUNIT'  => $valorunit,
                'DESCRICAO'  => $descricao,
                'CODORDEM'   => $id
            ]);
            return redirect()->back();
        }
    }
    //Salva ordem
    public function salvar()
    {
        $soma = 0;
        $result = 0;

        $model = new itensOrdemModel();
        $model2 = new OrdemModel();

        $ordem = $this->request->getVar('ordem'); 
        if ($ordem == null) {
            $itens = $model->getItem();

            foreach ($itens as $item) {
                $soma = $item['QUANTIDADE'] * $item['VALORUNIT'];
                $result += $soma;
                $soma = 0;
            }

            $model2->save([
                'VALOR'     => $result,
                'SITUACAO'  => 's',
                'DATA'      => Time::now()
            ]);

            $ordem = $model2->getInsertID();

            $model->where('CODORDEM IS NULL')->set('CODORDEM', $ordem)->update();
        } else {
            $itens = $model->getItem($ordem);

            foreach ($itens as $item) {
                $soma = $item['QUANTIDADE'] * $item['VALORUNIT'];
                $result += $soma;
                $soma = 0;
            }
            $model2->save([
                'CODORDEM'  => $ordem,
                'VALOR'     => $result,
                'SITUACAO'  => 's',
                'DATA'      => Time::now()

            ]);
        }

        return redirect()->to(base_url('ordem'));
    }

    //Excluir item (id do item)
    public function excluir_item($id = null)
    {
        $model = new itensOrdemModel();
        $model2 = new ProdutoModel();

        $model->where('CODITEMORDEM', $id)
            ->delete();

        $data = [
            'titulo'   => 'Gerar ordem de compra',
            'item'     => $model->getItem(),
            'produto'  => $model2->getProduto()
        ];

        return redirect()->back();
    }

    //Edita item da ordem (id do item)
    public function editar_item($id = null)
    {
        $model = new itensOrdemModel();
        $model2 = new ProdutoModel();

        $produto = $this->request->getVar('produto');
        $quantidade = $this->request->getVar('qtd');
        $valor = $this->request->getVar('valor');
        $descricao = $this->request->getVar('descricao');
        $ordem = $this->request->getVar('ordem');

        if ($ordem == null) {
            $model->save([
                'CODITEMORDEM'  => $id,
                'CODPRODUTO'    => $produto,
                'QUANTIDADE'    => $quantidade,
                'VALORUNIT'     => $valor,
                'DESCRICAO'     => $descricao
            ]);
            $data = [
                'titulo'   => 'Ordem de compra',
                'item'     => $model->getItem(),
                'produto'  => $model2->getProduto()
            ];
        } else {
            $model->save([
                'CODITEMORDEM'  => $id,
                'CODPRODUTO'    => $produto,
                'QUANTIDADE'    => $quantidade,
                'VALORUNIT'     => $valor,
                'DESCRICAO'     => $descricao,
                'CODORDEM'      => $ordem

            ]);
            $data = [
                'titulo'   => 'Ordem de compra',
                'item'     => $model->getItem($ordem),
                'produto'  => $model2->getProduto()
            ];
        }

        return redirect()->back();
    }


    //View de editar itens da ordem salva (id da ordem)
    public function editar($id = null)
    {
        $model = new itensOrdemModel();
        $model2 = new ProdutoModel();

        $data = [
            'titulo'    => 'Editar Ordem',
            'item'     => $model->getItem($id),
            'produto'   => $model2->getProduto(),
            'ordem'     => $id
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/criaordem');
        echo view('/templates/footer');
    }

//gerar pdf (id da ordem)
    public function geraPdf($id = null)
    {
        $dompdf = new Dompdf();
        $model = new itensOrdemModel();
        $item = $model->getItem($id);

        $dados = '<h1 style="text-align:center;">Descrição da Ordem</h1>';
        $dados .= '<br>';
        $dados .= '<table style="text-align:center;margin:auto;"><thead><tr>';
        $dados .= '<th>Código</th><th>Produto</th><th>Quantidade</th><th>Valor Unitário</th></tr></thead>';
        $dados .= '<tbody>';

        foreach ($item as $item_item) :
                $dados .= '<tr><td>' . $item_item['CODPRODUTO'] . '</td>';
                $dados .= '<td>' . $item_item['NOME'] . '</td>';
                $dados .= '<td>' . $item_item['QUANTIDADE'] . '</td>';
                $dados .= '<td>' . $item_item['VALORUNIT'] . '</td></tr>';
            
        endforeach;
        $dados .= '</tbody></table>';

        $dompdf->loadHtml($dados);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream();
    }

    //Emitir ordem de compra ( id da ordem)
    public function emitir($id=null){
        $model = new OrdemModel();
        $model2 = new EntradaModel();
        $model3 = new itensOrdemModel();
        $model4 = new EstoqueModel();

        $model  ->where('CODORDEM',$id)
                ->set('SITUACAO','e')
                ->update();


        $model2->save([
            'CODORDEM'  => $id,
            'DATA'      => Time::now()
        ]);
        

        $estoque = $model4->getEstoque();
        $item = $model3->getItem($id);
        

        for($i=0;$i<count($item);$i++){
            $aux=null;
            echo '<br>';
            for($j=0;$j<count($estoque);$j++){
                $soma=0;
                if($item[$i]['CODPRODUTO'] == $estoque[$j]['CODPRODUTO']){
                    $aux=456;
                    $soma=$item[$i]['QUANTIDADE'] + $estoque[$j]['QUANTIDADE'];

                    $model4->where('CODPRODUTO', $item[$i]['CODPRODUTO'])
                    ->set('QUANTIDADE',$soma)
                        ->update();
                }
            }
            if($aux==null){
                $model4->save([
                    'CODPRODUTO' => $item[$i]['CODPRODUTO'],
                    'QUANIDADE'  => $item[$i]['QUANTIDADE']
                ]);
            }
        }

        
        return redirect()->back();
    }
    
}

