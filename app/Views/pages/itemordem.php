<table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Código</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unit.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($item as $item_ordem):
                if($item_ordem['CODORDEM']== $id){
            ?>
                <tr class="table-secondary">
                    <td><?php echo $item_ordem['CODPRODUTO'] ?></td>
                    <td><?php echo $item_ordem['NOME'] ?></td>
                    <td><?php echo $item_ordem['QUANTIDADE'] ?></td>
                    <td><?php echo $item_ordem['VALORUNIT'] ?></td>
                </tr>
            <?php
                }
            endforeach;
            ?>
        </tbody>
    </table>
    <form action="/projeto3_igniter/public/item/pdf/<?= $id ?>" method="get">
        <input class="btn btn-secondary" type="submit" value="Gerar PDF">
    </form>