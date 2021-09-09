<hr />
<h2 class="text-center">LISTAGEM DE MENSALIDADES</h2>

<div class="col-12">
    <a href="<?= URL ?>/contrato/listar" class="btn btn-warning m-2">Voltar</a>
    <a href="<?= URL ?>/contrato/gerar/<?= $id ?>" class="btn btn-primary float-end m-2">Gerar Mensalidades</a>
</div>


<table class="table">
    <thead>
        <tr>
            <th scope="col">Vencimento Mensal.</th>
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
                <td class="align-middle"><?= date("d/m/Y", strtotime($mensalidade->mes)) ?></td>
                <td class="align-middle">R$ <?= number_format($mensalidade->mensalidade, 2, ",", "") ?></td>
                <td class="align-middle">R$ <?= number_format($mensalidade->repasse, 2, ",", "") ?></td>
                <td class="align-middle"><?= ($mensalidade->mensalidade_paga ? "<span class='badge bg-success align-middle'>Pago</span>" : ($mensalidade->pagamento_atrasado ? "<span class='badge bg-danger align-middle'>Atrasado</span>" : "<span class='badge bg-warning align-middle'>Pendente</span>")) ?></td>
                <td class="align-middle"><?= ($mensalidade->repasse_realizado ? "<span class='badge bg-success align-middle'>Pago</span>" : ($mensalidade->repasse_atrasado ?  "<span class='badge bg-danger align-middle'>Atrasado</span>" : "<span class='badge bg-warning align-middle'>Pendente</span>")) ?></td>
                <td class="align-middle text-center">
                    <?= (!$mensalidade->mensalidade_paga) ? '<a onclick="return confirm(\'Deseja pagar a mensalidade?\')" href="' . URL . '/contrato/mensalidadePaga/' . $mensalidade->id . '/' . $mensalidade->id_contrato . '" class="btn btn-success btn-sm" style="width: 48%; margin-right: 1%;">Pagar Mensalidade</a>' : '<a onclick="return confirm(\'Deseja cancelar a mensalidade?\')" href="' . URL . '/contrato/mensalidadeCancelada/' . $mensalidade->id . '/' . $mensalidade->id_contrato . '" class="btn btn-danger btn-sm" style="width: 48%; margin-right: 1%;">Cancelar Mensal.</a>' ?>
                    <?= (!$mensalidade->repasse_realizado) ? '<a onclick="return confirm(\'Deseja realizar o repasse?\')" href="' . URL . '/contrato/repasseRealizado/' . $mensalidade->id . '/' . $mensalidade->id_contrato . '" class="btn btn-success btn-sm" style="width: 48%; margin-left: 1%;">Pagar Repasse</a>' : '<a onclick="return confirm(\'Deseja cancelar o repasse?\')" href="' . URL . '/contrato/repasseCancelado/' . $mensalidade->id . '/' . $mensalidade->id_contrato . '" class="btn btn-danger btn-sm" style="width: 48%; margin-left: 1%;">Cancelar Repasse</a>' ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>