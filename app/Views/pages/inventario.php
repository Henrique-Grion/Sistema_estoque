<table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Produto</th>
                <th>Unid</th>
                <th>Qtd</th>
                <th>Opção</th>
            </tr>
        </thead>
        <tbody class="table-secondary">
            <?php
            foreach ($inventario as $item):
            ?>
                <tr>
                    <td><?= $item['CODPRODUTO'] ?></td>
                    <td><?= $item['NOME'] ?></td>
                    <td><?= $item['TIPO'] ?></td>
                    <form action="/projeto3_igniter/public/inventario/editar/<?= $item['CODINVENTARIO'] ?>" method="post">
                        <td><input class="form-control" type="text" name="qtd" id="qtd" value="<?= $item['QUANTIDADE'] ?>" size="3"></td>
                        <td><input class="btn btn-warning" type="submit" name="acao" id="acao" value="Editar">
                    </form>
                    <a href="/projeto3_igniter/public/inventario/excluir/<?= $item['CODINVENTARIO']?>"><input class="btn btn-danger" type="submit" name="acao" id="acao" value="Excluir"></a></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>

    <form style="width:90%;margin:2px;" class="row gx-2 gy-2 align-items-center" action="/projeto3_igniter/public/inventario/adicionar" method="post">
        <div class="col-sm-2">
            <label class="visually-hidden" for="form-select">Produto</label>
            <select class="form-select" id="produto" name="produto">
                <option value="" disabled selected>Selecione...</option>
                <?php
                foreach($produto as $produto_item) :
                ?>
                    <option value="<?= $produto_item['CODPRODUTO'] ?>"><?= $produto_item['NOME'] ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="col-sm-2">
            <label class="visually-hidden" for="specificSizeInputName">Quantidade</label>
            <input type="text" class="form-control" id="qtd" name="qtd" placeholder="Quantidade">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </form>
    <form style="margin-top:6px;" action="/projeto3_igniter/public/inventario/salvar">
        <div class="d-grid gap-2">
            <input class="btn btn-success" type="submit" value="Salvar Estoque">
        </div>
    </form>