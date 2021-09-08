<hr />
<h2 class="text-center">LISTAGEM DE MENSALIDADES</h2>

<div class="col-12">
    <a href="<?= URL ?>/contrato/listar" class="btn btn-warning m-2">Voltar</a>
    <a href="<?= URL ?>/contrato/gerar/<?=$id?>" class="btn btn-primary float-end m-2">Gerar Mensalidades</a>
</div>

<div class="col-3 m-2 float-end">
    <input class="form-control" id="" placeholder="Pesquisa.."></input>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Valor da Mensalidade</th>
            <th scope="col">Valor do Repasse</th>
            <th scope="col">Status Mensalidade</th>
            <th scope="col">Status Repasse</th>
            <th scope="col" class="col-3 text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array_mensalidades as $mensalidade) { ?>
            <tr>
                <td class="align-middle"><?= $mensalidade->mensalidade ?></td>
                <td class="align-middle"><?= $mensalidade->repasse ?></td>
                <td class="align-middle"><?= $mensalidade->mensalidade_paga ?></td>
                <td class="align-middle"><?= $mensalidade->repasse_realizado ?></td>
                <td class="align-middle text-center">
                    <a href="<?= URL ?>/contrato/mensalidade_paga/<?= $mensalidade->id ?>" class="btn btn-success btn-sm" style="width: 32%; margin-right: 1%;">Pagar Mensalidade</a>
                    <a href="<?= URL ?>/contrato/repasse_realizado/<?= $mensalidade->id ?>" class="btn btn-success btn-sm" style="width: 32%;">Pagar Repasse</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>