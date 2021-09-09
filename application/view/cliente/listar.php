<hr />
<h2 class="text-center">LISTAGEM DE CLIENTES</h2>

<div class="col-12">
    <a href="<?= URL ?>" class="btn btn-warning m-2">Voltar</a>
    <a href="<?= URL ?>/cliente/cadastro" class="btn btn-primary float-end m-2">Cadastrar novo</a>
</div>


<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Telefone</th>
            <th scope="col" class="col-3 text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array_clientes as $cliente) { ?>
            <tr>
                <td class="align-middle"><?= $cliente->nome ?></td>
                <td class="align-middle"><?= $cliente->email ?></td>
                <td class="align-middle"><?= $cliente->telefone ?></td>
                <td class="align-middle">
                    <a href="<?= URL ?>/cliente/cadastro/<?= $cliente->id ?>" class="btn btn-info btn-sm" style="width: 48%; margin-right: 2%;">Editar</a>
                    <a href="<?= URL ?>/cliente/apagar/<?= $cliente->id ?>" class="btn btn-danger float-end btn-sm" style="width: 48%; margin-left: 2%;" onclick="return confirm('Deseja excluir o cliente?')">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>