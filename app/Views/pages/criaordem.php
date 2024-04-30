<table class="table table-hover align-middle">
    <thead>
        <tr>
            <th>Código</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor Unitário</th>
            <th>Descrição</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($item as $ordem_item) :
        ?>
                <tr class="table-secondary">

                    <!-- FORMULARIO PARA EDITAR E EXCLUIR OS PRODUTOS DE UMA ORDEM DE COMPRA JA SALVA-->
                    <form action="/projeto3_igniter/public/ordem/editaritem/<?= $ordem_item['CODITEMORDEM'] ?>" method="post">
                    <td><?php echo $ordem_item['CODPRODUTO'] ?></td>
                    <td><?php echo $ordem_item['NOME'] ?></td>
                    <input type="hidden" name="produto" value="<?= $ordem_item['CODPRODUTO'] ?>">
                    <td><input class="form-control" type="text" name="qtd" id="qtd" value="<?php echo $ordem_item['QUANTIDADE'] ?>" size="2"></td>
                    <td><input class="form-control" type="text" name="valor" id="valor" value="<?php echo $ordem_item['VALORUNIT'] ?>" size="4"></td>
                    <td><input class="form-control" type="text" name="descricao" id="descricao" value="<?php echo $ordem_item['DESCRICAO'] ?>"></td>
                    <input type="hidden" name="ordem" value="<?= $ordem_item['CODORDEM'] ?>">
                    
                        <td><input class="btn btn-warning" type="submit" name="acao" id="acao" value="Editar">
                    </form>
                    <a href="/projeto3_igniter/public/ordem/excluiritem/<?= $ordem_item['CODITEMORDEM'] ?>"><input class="btn btn-danger" type="submit" name="acao" id="acao" value="Excluir"></a></td>
                </tr>
        <?php
            
        endforeach;
        ?>

    </tbody>
</table>
<?php if (isset($msg)) { ?>
    <div class="p-2 bg-danger-subtle border border-danger rounded-3">
        <?= $msg ?>
    </div>
<?php } ?>

<!-- FORMULARIO PARA ADICIONAR PRODUTOS A UMA ORDEM DE COMPRA SALVA--------------------------------------->
<form style="width:90%;margin:2px;" class="row gx-2 gy-2 align-items-center" action="/projeto3_igniter/public/ordem/adicionar<?php if(isset($ordem)){echo '/'.$ordem;}else{}?>" method="post">
    <div class="col-sm-2">
        <label class="visually-hidden" for="specificSizeSelect">Produto</label>
        <select class="form-select" id="produto" name="produto">
            <option value="" disabled selected>Selecione...</option>
            <?php
            foreach ($produto as $produto_item) :
            ?>
                <option value="<?php echo $produto_item['CODPRODUTO'] ?>"><?php echo $produto_item['NOME'] ?></option>
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
        <label class="visually-hidden" for="specificSizeInputName">Valor</label>
        <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor Unitário">
    </div>
    <div class="col-sm-2">
        <label class="visually-hidden" for="specificSizeInputName">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
</form>

<!--Formulário para Salvar Ordem----------------------------------------------------------- -->
<form style="margin-top:6px;" action="/projeto3_igniter/public/ordem/salvar" method="post">
    <div class="d-grid gap-2">
        <input class="btn btn-success" type="submit" value="Salvar Ordem">
        <input type="hidden" name="ordem" value="<?php if(isset($ordem)){echo $ordem;}?>">
    </div>
</form>