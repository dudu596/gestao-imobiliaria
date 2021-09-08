<hr />
<h2 class="text-center">LISTAGEM DE IMÓVEIS</h2>

<div class="col-12">
    <a href="<?= URL ?>" class="btn btn-warning m-2">Voltar</a>
    <a href="<?= URL ?>/imovel/cadastro" class="btn btn-primary float-end m-2">Cadastrar novo</a>
</div>

<div class="col-3 m-2 float-end">
    <input class="form-control" id="" placeholder="Pesquisa.."></input>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Proprietário</th>
            <th scope="col">Endereço</th>
            <th scope="col" class="col-3 text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array_imoveis as $imovel) { ?>
            <tr>
                <td class="align-middle"><?= $imovel->nome ?></td>
                <td class="align-middle"><?= $imovel->rua . ", Nº" . $imovel->numero . " - " . $imovel->bairro . " - " . $imovel->cidade ?></td>
                <td class="align-middle">
                    <a href="<?= URL ?>/imovel/cadastro/<?= $imovel->id ?>" class="btn btn-info btn-sm" style="width: 48%; margin-right: 2%;">Editar</a>
                    <a href="<?= URL ?>/imovel/apagar/<?= $imovel->id ?>" class="btn btn-danger float-end btn-sm" style="width: 48%; margin-left: 2%;" onclick="return confirm('Deseja excluir o imovel?')">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>