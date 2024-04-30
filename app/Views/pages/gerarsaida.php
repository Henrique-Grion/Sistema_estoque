<table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Setor</th>
                <th>Opção</th>
            </tr>
        </thead>
        <tbody class="table-secondary">
            <?php
            foreach($saida as $saida) :
            ?>
                <tr>
                        <form action="/projeto3_igniter/public/saida/editar" method="post">
                            <td><?= $saida['CODPRODUTO'] ?></td>
                            <td><?= $saida['PRODUTO']?></td>
                            <td><input class="form-control" type="text" name="qtd" id="qtd" value="<?= $saida['QUANTIDADE']?>" size="4"></td>
                            <td><?= $saida['SETOR'] ?></td>
                            <td><input class="btn btn-warning" type="submit" name="acao" id="acao" value="Editar">
                            <input type="hidden" name="id" id="id" value="<?=$saida['CODITEMSAIDA'] ?>">
                            <input type="hidden" name="produto" id="produto" value="<?= $saida['CODPRODUTO']?>">
                        </form>
                            <a href="/projeto3_igniter/public/saida/excluir/<?= $saida['CODITEMSAIDA']?>"><input class="btn btn-danger" type="submit" name="acao" id="acao" value="Excluir"></a></td>
                        
                </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>

    <form style="width:90%;margin:2px;" class="row gx-2 gy-2 align-items-center" action="/projeto3_igniter/public/saida/adicionar" method="post">
        <div class="col-sm-2">
            <label class="visually-hidden" for="specificSizeSelect">Produto</label>
            <select class="form-select" id="produto" name="produto">
                <option value="" disabled selected>Selecione...</option>
                <?php
                foreach($produto as $produto) :
                ?>
                    <option value="<?= $produto['CODPRODUTO']?>"><?= $produto['NOME']?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="col-sm-2">
            <label class="visually-hidden" for="specificSizeInputName">Quantidade</label>
            <input type="text" class="form-control" id="qtd" name="qtd" placeholder="Quantidade">
        </div>
        <div class="col-sm-2">
            <label class="visually-hidden" for="specificSizeInputName">Setor</label>
            <select class="form-select" name="setor" id="setor">
            <option value="" disabled selected>Setor</option>
            <?php
            foreach($setor as $setor) :
            ?>
                <option value="<?= $setor['CODSETOR'] ?>"><?= $setor['NOME']?></option>
            <?php
            endforeach;
            ?>
        </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </form>
    <form style="margin-top:6px;" action="/projeto3_igniter/public/saida/salvar">
        <div class="d-grid gap-2">
            <input class="btn btn-success" type="submit" value="Gerar Saida">
        </div>
    </form>