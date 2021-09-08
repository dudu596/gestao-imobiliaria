<hr />
<h2 class="text-center">LISTAGEM DE CONTRATOS</h2>

<div class="col-12">
    <a href="<?= URL ?>" class="btn btn-warning m-2">Voltar</a>
    <a href="<?= URL ?>/contrato/cadastro" class="btn btn-primary float-end m-2">Cadastrar novo</a>
</div>

<div class="col-3 m-2 float-end">
    <input class="form-control" id="" placeholder="Pesquisa.."></input>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Imóvel</th>
            <th scope="col">Cliente</th>
            <th scope="col" class="col-6 text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array_contratos as $contrato) { ?>
            <tr>
                <td class="align-middle"><?= $contrato->rua . ", Nº" . $contrato->numero . " - " . $contrato->bairro . " - " . $contrato->cidade ?></td>
                <td class="align-middle"><?= $contrato->nome ?></td>
                <td class="align-middle text-center">
                    <a href="<?= URL ?>/contrato/mensalidade/<?= $contrato->id ?>" class="btn btn-primary btn-sm" style="width: 32%; margin-right: 1%;">Ver Mensalidades</a>
                    <a href="<?= URL ?>/contrato/cadastro/<?= $contrato->id ?>" class="btn btn-info btn-sm" style="width: 32%; margin-right: 1%;">Editar</a>
                    <a href="<?= URL ?>/contrato/apagar/<?= $contrato->id ?>" class="btn btn-danger btn-sm" style="width: 32%;" onclick="return confirm('Deseja excluir o contrato?')">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>