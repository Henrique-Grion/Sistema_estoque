<table style="text-align:center;" class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Ordem de Compra</th>
                <th>Valor Total</th>
                <th>Data</th>
                <th>Situação</th>
                <th>Visualizar</th>
                <th></th>
                <th>Opções</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($ordem as $ordem_item) :
            ?>
                <tr class="table-secondary">
                    <td><?php echo $ordem_item['CODORDEM'] ?></td>
                    <td><?php echo $ordem_item['VALOR'] ?></td>
                    <td><?php echo $ordem_item['DATA'] ?></td>
                    <td><?php echo $ordem_item['SITUACAO'] ?></td>
                    <form action="/projeto3_igniter/public/item/<?php echo $ordem_item['CODORDEM']?>" method="get">
                        <td><input class="btn btn-primary" type="submit" value="Visualizar"></td>
                        <input type="hidden" name="id" id="id" value="<?php echo $ordem_item['CODORDEM'] ?>">
                    </form>
                    <?php if ($ordem_item['SITUACAO'] != 'e') { ?>
                        <form action="/projeto3_igniter/public/ordem/editar/<?php echo $ordem_item['CODORDEM'] ?>" method="get">
                            <td><input class="btn btn-warning" type="submit" name="acao" id="acao" value=
                            "Editar"></td>
                        </form>
                        <form action="/projeto3_igniter/public/ordem/excluir/<?php echo $ordem_item['CODORDEM'] ?>" method="get">
                            <td><input class="btn btn-danger" type="submit" value=
                            "Excluir"></td>
                        </form>
                        <form action="/projeto3_igniter/public/ordem/emitir/<?php echo $ordem_item['CODORDEM'] ?>" method="get">
                            <td><input class="btn btn-success" type="submit" value=
                            "Emitir"></td>
                        </form>
                    <?php } else { ?>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php } ?>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>