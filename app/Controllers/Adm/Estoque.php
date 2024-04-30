<?php

namespace App\Controllers\Adm;

require './../dompdf/vendor/autoload.php';

use App\Controllers\BaseController;
use App\Models\EstoqueModel;
use CodeIgniter\I18n\Time;
use Dompdf\Dompdf;


class Estoque extends BaseController
{

    public function index()
    {

        $model = new EstoqueModel();
        $data = [
            'titulo'    => 'Estoque',
            'estoque'   => $model->getEstoque(),
            'msg'       => ''
        ];
        echo view('/templates/header-html', $data);
        echo view('/templates/header');
        echo view('/pages/estoque');
        echo view('/templates/footer');
    }
    public function geraPdf()
    {
        $dompdf = new Dompdf();
        $model = new EstoqueModel();
        $estoque = $model->getEstoque();

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
        
        $dados .='<div class="page"><h1>Relatório de Estoque</h1>';
        $dados .= '<div class="data"><u>' . Time::now() . '</u></div>';
        $dados .= '<br>';
        $dados .= '<table border="1"><thead><tr>';
        $dados .= '<th>Código</th><th>Produto</th><th>Und.</th><th>Categoria</th><th>Qntd.</th><th>Marca</th></tr></thead>';
        $dados .= '<tbody>';

        foreach ($estoque as $estoque_item) :
            $dados .= '<tr><th>' . $estoque_item['CODPRODUTO'] . '</th>';
            $dados .= '<td>' . $estoque_item['produto'] . '</td>';
            $dados .= '<td>' . $estoque_item['TIPO'] . '</td>';
            $dados .= '<td>' . $estoque_item['categoria'] . '</td>';
            $dados .= '<td>' . $estoque_item['QUANTIDADE'] . '</td>';
            $dados .= '<td>' . $estoque_item['MARCA'] . '</td></tr>';
        endforeach;
        $dados .= '</tbody></table></div>';

        $dompdf->loadHtml($dados);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream();
    }
}
