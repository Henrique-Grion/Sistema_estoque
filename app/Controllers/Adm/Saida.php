<?php

namespace App\Controllers\Adm;

require './../dompdf/vendor/autoload.php';

use App\Controllers\BaseController;
use App\Models\EstoqueModel;
use App\Models\SaidaModel;
use App\Models\itenSaidaModel;
use App\Models\itensOrdemModel;
use App\Models\ProdutoModel;
use App\Models\SetorModel;
use Dompdf\Dompdf;
use CodeIgniter\I18n\Time;

class Saida extends BaseController
{

    public function index()
    {
        $data = [
            'titulo' => 'Saidas'
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/saida');
        echo view('/templates/footer');
    }

    public function gerar()
    {
        $model = new itenSaidaModel();
        $model2 = new ProdutoModel();
        $model3 = new SetorModel();

        $data = [
            'titulo'    => 'Gerar saidas',
            'saida'     => $model->getItem(),
            'produto'   => $model2->getProduto(),
            'setor'     => $model3->getSetor()
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/gerarsaida');
        echo view('/templates/footer');
    }

    public function buscar()
    {
        $model = new SaidaModel();

        $de = $this->request->getVar('de').' 00:00:00';
        $ate = $this->request->getVar('ate').' 23:59:59';

        $data = [
            'titulo'    => 'Saidas',
            'saida'   => $model->getSaida($de, $ate)
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/saida');
        echo view('/templates/footer');
    }

    public function visualiza($id = null)
    {
        $model = new itenSaidaModel();

        $data = [
            'titulo'    => 'Itens da Saida',
            'saida'     => $model->getItem($id),
            'id'        => $id
        ];

        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/itemsaida');
        echo view('/templates/footer');
    }

    public function geraPdf($id = null)
    {
        $dompdf = new Dompdf();
        $model = new itenSaidaModel();
        $saida = $model->getItem($id);

        $dados = '
        <style>
            h1{
                text-align:center;
                border-bottom:1px solid black;
            }
            .data{
                text-align:right;
            }
            table{
                text-align:center;
                margin:auto;
            }
            table,th,td{
                border-collapse:collapse;
                padding:10px;
            }
            thead{
                background-color:lightgrey;
            }
            .page{
                margin-left:15px;
                margin-right:15px;
            }
            
        </style>';

        $dados .= '<div class="page"><h1>Relatório de Saida</h1>';
        $dados .= '<div class="data"><u>' . Time::now() . '</u></div>';
        $dados .= '<br>';
        $dados .= '<table border="1"><thead><tr>';
        $dados .= '<th>Código</th><th>Produto</th><th>Quantidade</th><th>Setor</th></tr></thead>';
        $dados .= '<tbody>';

        foreach ($saida as $saida) :
            $dados .= '<tr><th>' . $saida['CODPRODUTO'] . '</th>';
            $dados .= '<td>' . $saida['PRODUTO'] . '</td>';
            $dados .= '<td>' . $saida['QUANTIDADE'] . '</td>';
            $dados .= '<td>' . $saida['SETOR'] . '</td></tr>';
        endforeach;
        $dados .= '</tbody></table></div>';

        $dompdf->loadHtml($dados);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream();
    }

    public function adicionar()
    {
        $model = new itenSaidaModel();
        $model2 = new EstoqueModel();

        $estoque = $model2->getEstoque();
        $item = $model->getItem();
        $valida = null;
        $valida2=true;


        $produto = $this->request->getVar('produto');
        $quantidade = $this->request->getVar('qtd');
        $setor = $this->request->getVar('setor');
        $valida3 = $quantidade;

        foreach ($item as $i){
            if($i['CODPRODUTO'] == $produto && $i['SETOR'] == $setor){
                $valida2=false;
            }
            if($i['CODPRODUTO'] == $produto){
                $valida3+=$i['QUANTIDADE'];
            }
        }

        foreach ($estoque as $e) {
            if ($produto == $e['CODPRODUTO'] && $valida3 <= $e['QUANTIDADE']) {
                $valida = true;
            }
        }


        if ($valida == true && $valida2 == true) {
            $model->save([
                'CODSETOR'      => $setor,
                'CODPRODUTO'    => $produto,
                'QUANTIDADE'    => $quantidade
            ]);
        }

        return redirect()->back();
    }

    public function editar(){
        $model = new itenSaidaModel();
        $model2 = new EstoqueModel();

        $item = $model->getItem();
        $estoque = $model2->getEstoque();

        $quantidade = $this->request->getVar('qtd');
        $id = $this->request->getVar('id');
        $produto = $this->request->getVar('produto');

        $valida3 = 0;
        $valida = false;

        foreach($item as $i){
            if($i['CODPRODUTO'] == $produto){
                if($i['CODITEMSAIDA'] == $id){
                    $valida3 += $quantidade;
                }
                else{
                    $valida3 += $i['QUANTIDADE'];
                }        
            }
        }
        foreach ($estoque as $e) {
            if ($produto == $e['CODPRODUTO'] && $valida3 <= $e['QUANTIDADE']) {
                $valida = true;
            }
        }

        if($valida == true){
            $model->save([
                'CODITEMSAIDA'  => $id,
                'QUANTIDADE'    => $quantidade
            ]);
        }
        return redirect()->back();
    }

    public function excluir($id=null){
        $model = new itenSaidaModel();

        $model->where('CODITEMSAIDA',$id)->delete();

        return redirect()->back();
    }

    
    public function salvar(){
        $model = new SaidaModel();
        $model2 = new itenSaidaModel();
        $model3 = new EstoqueModel();

        $item = $model2->getItem();
        $estoque = $model3->getEstoque();
        $count = count($item);
        $soma=0;

        $model->save([
            'DATA'      => Time::now(),
            'ITENS'     => $count
        ]);

        foreach($item as $item){
            foreach($estoque as $es){
                if($es['CODPRODUTO'] == $item['CODPRODUTO']){
                    $soma = $es['QUANTIDADE'] - $item['QUANTIDADE'];
                    $model3->where('CODPRODUTO',$item['CODPRODUTO'])->set('QUANTIDADE',$soma)->update();
                }
            }
        }
        $saida = $model->getInsertID();

        $model2->where('CODSAIDA IS NULL')->set('CODSAIDA',$saida)->update();
    }
}
