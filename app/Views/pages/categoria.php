<table style="text-align:center;" class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Opção</th>
            </tr>
        </thead>
        <tbody class="table-secondary">
            <?php
            for ($i = 0; $i < count($categoria); $i++) {
            ?>
                <tr>
                    <td><?php echo $categoria[$i]['CODCATEGORIA'] ?></td>
                    <td><?php echo $categoria[$i]['NOME'] ?></td>
                    <form action="/projeto3_igniter/public/categorias/excluir/<?php echo $categoria[$i]['CODCATEGORIA'] ?>" method="get">
                        <td><input class="btn btn-danger" type="submit" name="acao" id="acao" value="Excluir"></td>
                        <input type="hidden" name="id" id="id" value="<?php echo $categoria[$i]['CODCATEGORIA'] ?>">
                    </form>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <form style="width:90%;margin:2px;" class="row gx-2 gy-2 align-items-center" action="/projeto3_igniter/public/categorias/adicionar" method="post">
        <div class="col-sm-2">
            <label class="visually-hidden" for="specificSizeInputName">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome...">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </form>
