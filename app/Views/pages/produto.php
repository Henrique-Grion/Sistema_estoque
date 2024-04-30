<table style="text-align:center;" class="table table-hover align-middle">
    <thead>
        <tr>
            <th>Código</th>
            <th>Unidade</th>
            <th>Categoria</th>
            <th>Nome</th>
            <th>Marca</th>
            <td></td>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($produto as $produto_item) :
        ?>
            <form action="/projeto3_igniter/public/produtos/editar/<?= $produto_item['CODPRODUTO'] ?>" method="get">
                <tr class="table-secondary">
                    <td><?php echo $produto_item['CODPRODUTO'] ?></td>
                    <td>
                        <select class="form-select" name="unidade" id="unidade">
                            <?php
                            foreach ($unidade as $unidade_item) :
                                $selecionado = '';
                                if ($unidade_item['CODUNIDADE'] == $produto_item['CODUNIDADE']) {
                                    $selecionado = 'selected';
                                }
                            ?>
                                <option value="<?php echo $unidade_item['CODUNIDADE'] ?>" <?php echo $selecionado ?>><?php echo $unidade_item['TIPO'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="categoria" id="categoria">
                            <?php
                            foreach ($categoria as $categoria_item) :
                                $selecionado = '';
                                if ($categoria_item['CODCATEGORIA'] == $produto_item['CODCATEGORIA']) {
                                    $selecionado = 'selected';
                                }
                            ?>
                                <option value="<?php echo $categoria_item['CODCATEGORIA'] ?>" <?php echo $selecionado ?>><?php echo $categoria_item['NOME'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </td>
                    <td><input class="form-control" type="text" name="nome" id="nome" value="<?php echo $produto_item['NOME'] ?>"></td>
                    <td><input class="form-control" type="text" name="marca" id="marca" value="<?php echo $produto_item['MARCA'] ?>"></td>
                    <td><input class="btn btn-warning" type="submit" name="acao" id="acao" value="Editar"></td>
            </form>
            <form action="/projeto3_igniter/public/produtos/excluir/<?= $produto_item['CODPRODUTO'] ?>" method="get">
                <td><input class="btn btn-danger" type="submit" name="acao" id="acao" value="Excluir"></td>
                </tr>
            </form>
        <?php
        endforeach;
        ?>
    </tbody>
</table>

<form style="width:90%;margin:2px;" class="row gx-2 gy-2 align-items-center" action="/projeto3_igniter/public/produtos/adicionar" method="post">
    <div class="col-sm-2">
        <label class="visually-hidden" for="specificSizeSelect">Unidade</label>
        <select class="form-select" id="unidade" name="unidade">
            <option value="" disabled selected>Unidade...</option>
            <?php
            foreach ($unidade as $unidade_item) :
            ?>
                <option value="<?php echo $unidade_item['CODUNIDADE'] ?>"><?php echo $unidade_item['TIPO'] ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <div class="col-sm-2">
        <label class="visually-hidden" for="specificSizeSelect">Categoria</label>
        <select class="form-select" id="categoria" name="categoria">
            <option value="" disabled selected>Categoria...</option>
            <?php
            foreach ($categoria as $categoria_item) :
            ?>
                <option value="<?php echo $categoria_item['CODCATEGORIA'] ?>"><?php echo $categoria_item['NOME'] ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <div class="col-sm-2">
        <label class="visually-hidden" for="specificSizeInputName">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome...">
    </div>
    <div class="col-sm-2">
        <label class="visually-hidden" for="specificSizeInputName">Marca</label>
        <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca...">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
</form>