<table style="text-align:center;" class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Opção</th>
            </tr>
        </thead>
        <tbody class="table-secondary">
            <?php
            for ($i = 0; $i < count($unidade); $i++) {
            ?>
                <tr>
                    <td><?php echo $unidade[$i]['CODUNIDADE'] ?></td>
                    <td><?php echo $unidade[$i]['TIPO'] ?></td>
                    <form action="/projeto3_igniter/public/unidades/excluir/<?=$unidade[$i]['CODUNIDADE']?>" method="get">
                        <td><input class="btn btn-danger" type="submit" name="acao" id="acao" value="Excluir"></td>
                        <input type="hidden" name="id" id="id" value="<?php echo $unidade[$i]['CODUNIDADE'] ?>">
                    </form>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <form style="width:90%;margin:2px;" class="row gx-2 gy-2 align-items-center" action="/projeto3_igniter/public/unidades/adicionar" method="post">
        <div class="col-sm-2">
            <label class="visually-hidden" for="specificSizeInputName">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo...">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </form>
