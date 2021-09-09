<?php if (isset($_GET['erro'])) {
    $string = implode(", ", explode("-", $_GET['erro'])); ?>
    <div class="alert alert-warning" role="alert">
        <h4>Ocorreu um erro!</h4>
        <?= "Valores para dados \"{$string}\" incorretos." ?>
    </div>
<?php } ?>

<form action="" method="post">
    <hr />
    <h3 class="text-center m-3"><?= $titulo ?></h3>
    <div class="mb-3">
        <label for="id_cliente" class="form-label" name="id_cliente">Cliente *:</label>
        <select id="id_cliente" name="id_cliente" class="form-select" required>
            <option value="">Selecione</option>
            <?php foreach ($array_cliente as $cliente) { ?>
                <option value="<?= $cliente->id ?>" <?= isset($contrato_atualiza->id_cliente) ? ($contrato_atualiza->id_cliente == $cliente->id ? "selected" : "") : "" ?>><?= $cliente->nome ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_proprietario" class="form-label" name="id_proprietario">Proprietário *:</label>
        <select id="id_proprietario" name="id_proprietario" class="form-select" required>
            <option value="">Selecione</option>
            <?php foreach ($array_proprietario as $proprietario) { ?>
                <option value="<?= $proprietario->id ?>" <?= isset($contrato_atualiza->id_proprietario) ? ($contrato_atualiza->id_proprietario == $proprietario->id ? "selected" : "") : "" ?>><?= $proprietario->nome ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_imovel" class="form-label" name="id_imovel">Imóvel *:</label>
        <select id="id_imovel" name="id_imovel" class="form-select" required>
            <option value="">Selecione</option>
        </select>
        <input type="text" hidden id="imovel" value="<?= isset($contrato_atualiza->id_imovel) ? $contrato_atualiza->id_imovel : "" ?>">
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <label for="data_inicio" class="form-label">Data Inicial *:</label>
            <input type="date" class="form-control" id="data_inicio" name="data_inicio" max="9999-12-31" value="<?= isset($contrato_atualiza->data_inicio) ? $contrato_atualiza->data_inicio : "" ?>" required>
        </div>
        <div class="col-6 mb-3">
            <label for="data_fim" class="form-label">Data Final *:</label>
            <input type="date" class="form-control" id="data_fim" name="data_fim" max="9999-12-31" value="<?= isset($contrato_atualiza->data_fim) ? $contrato_atualiza->data_fim : "" ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <label for="taxa_administracao" class="form-label">Taxa de Administração *:</label>
            <input type="number" class="form-control" id="taxa_administracao" name="taxa_administracao" value="<?= isset($contrato_atualiza->taxa_administracao) ? $contrato_atualiza->taxa_administracao : "" ?>" required>
        </div>
        <div class="col-6 mb-3">
            <label for="valor_aluguel" class="form-label">Valor do Aluguel *:</label>
            <input type="number" class="form-control" id="valor_aluguel" name="valor_aluguel" value="<?= isset($contrato_atualiza->valor_aluguel) ? $contrato_atualiza->valor_aluguel : "" ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <label for="valor_condominio" class="form-label">Valor do Condominio *:</label>
            <input type="number" class="form-control" id="valor_condominio" name="valor_condominio" value="<?= isset($contrato_atualiza->valor_condominio) ? $contrato_atualiza->valor_condominio : "" ?>" required>
        </div>
        <div class="col-6 mb-3">
            <label for="valor_iptu" class="form-label">Valor do IPTU *:</label>
            <input type="number" class="form-control" id="valor_iptu" name="valor_iptu" value="<?= isset($contrato_atualiza->valor_iptu) ? $contrato_atualiza->valor_iptu : "" ?>" required>
        </div>
    </div>
    <div class="mb-3">
        <a class="btn btn-warning mt-3" href="<?= URL ?>/contrato/listar" type="button" value="voltar">Voltar</a>
        <button class="btn btn-success float-end mt-3" type="submit"><?= isset($contrato_atualiza->id) ? "Alterar" : "Criar" ?></button>
    </div>
</form>
<script src="<?= URL ?>/public/js/jquery-3.6.0.min.js"></script>
<script src="<?= URL ?>/public/js/contrato.js"></script>