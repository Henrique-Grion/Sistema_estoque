<form style=" width:100%; margin-left:0px; background-color:lightgrey;border-bottom:6px solid grey;padding:2px;" class="row galign-items-center" action="/projeto3_igniter/public/entrada/buscar" method="post">
        <div class="col-auto">
            <b>De:</b>
        </div>
        <div class="col-auto">
            <input class="form-control" type="date" name="de" value="<?php echo date('Y-m-d') ?>" min="2024-01-01">
        </div>
        <div class="col-auto">
            <b>Até:</b>
        </div>
        <div class="col-auto" >
            <input class="form-control" type="date" name="ate" value="<?php echo date('Y-m-d') ?>" min="2024-01-01">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Buscar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </button>

        </div>
    </form>
    <br>

    <?php
    if (isset($entrada)) {
    ?>
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Código Ordem</th>
                    <th>Data</th>
                    <th>Opção</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($o = 0; $o < count($entrada); $o++) {
                ?>
                    <tr class="table-secondary">
                        <form action="/projeto3_igniter/public/item/<?= $entrada[$o]['CODORDEM'] ?>" method="get">
                            <td><?php echo $entrada[$o]['CODORDEM'] ?></td>
                            <td><?php echo $entrada[$o]['DATA'] ?></td>
                            <td><input class="btn btn-primary" type="submit" value="Visualizar"></td>
                            <input type="hidden" name="id" id="id" value="<?php echo $entrada[$o]['CODORDEM'] ?>">
                        </form>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
