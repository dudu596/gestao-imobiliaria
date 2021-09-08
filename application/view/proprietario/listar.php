<hr />
<h2 class="text-center">LISTAGEM DE PROPRIETÁRIOS</h2>

<div class="col-12">
    <a href="<?= URL ?>" class="btn btn-warning m-2">Voltar</a>
    <a href="<?= URL ?>/proprietario/cadastro" class="btn btn-primary float-end m-2">Cadastrar novo</a>
</div>

<div class="col-3 m-2 float-end">
    <input class="form-control" id="" placeholder="Pesquisa.."></input>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Telefone</th>
            <th scope="col">Repasse</th>
            <th scope="col" class="col-3 text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array_proprietarios as $proprietario) { ?>
            <tr>
                <td class="align-middle"><?= $proprietario->nome ?></td>
                <td class="align-middle"><?= $proprietario->email ?></td>
                <td class="align-middle"><?= $proprietario->telefone ?></td>
                <td class="align-middle">dia: <?= $proprietario->dia_repasse ?></td>
                <td class="align-middle">
                    <a href="<?= URL ?>/proprietario/cadastro/<?= $proprietario->id ?>" class="btn btn-info btn-sm" style="width: 48%; margin-right: 2%;">Editar</a>
                    <a href="<?= URL ?>/proprietario/apagar/<?= $proprietario->id ?>" class="btn btn-danger float-end btn-sm" style="width: 48%; margin-left: 2%;" onclick="return confirm('Deseja excluir o proprietario?')">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

