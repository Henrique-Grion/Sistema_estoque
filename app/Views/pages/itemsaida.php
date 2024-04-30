<table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Código</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Setor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($o = 0; $o < count($saida); $o++) {
            ?>
                <tr class="table-secondary">
                    <td><?php echo $saida[$o]['CODPRODUTO'] ?></td>
                    <td><?php echo $saida[$o]['PRODUTO'] ?></td>
                    <td><?php echo $saida[$o]['QUANTIDADE'] ?></td>
                    <td><?php echo $saida[$o]['SETOR'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <form action="/projeto3_igniter/public/saida/pdf/<?= $id ?>" method="get">
        <input class="btn btn-secondary" type="submit" value="Gerar PDF">
    </form>