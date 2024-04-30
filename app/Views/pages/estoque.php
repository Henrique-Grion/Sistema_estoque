<table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Produto</th>
                <th scope="col">Und.</th>
                <th scope="col">Categoria</th>
                <th scope="col">Qntd.</th>
                <th scope="col">Marca</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($estoque as $estoque_item): ?>
                <tr class="table-secondary">
                    <td scope="row"><?php echo $estoque_item ['CODPRODUTO'] ?></td>
                    <td scope="row"><?php echo $estoque_item ['produto'] ?></td>
                    <td scope="row"><?php echo $estoque_item ['TIPO'] ?></td>
                    <td scope="row"><?php echo $estoque_item ['categoria'] ?></td>
                    <td scope="row"><?php echo $estoque_item ['QUANTIDADE'] ?></td>
                    <td scope="row"><?php echo $estoque_item ['MARCA'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form action="/projeto3_igniter/public/estoque/pdf">
        <input class="btn btn-secondary" type="submit" value="Gerar PDF">
    </form>