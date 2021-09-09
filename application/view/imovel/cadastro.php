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
        <label for="id_proprietario" class="form-label" name="id_proprietario">Proprietário *:</label>
        <select id="id_proprietario" name="id_proprietario" class="form-select" required>
            <option value="">Selecione</option>
            <?php foreach ($array_proprietario as $proprietario) { ?>
                <option value="<?= $proprietario->id ?>" <?= isset($imovel_atualiza->id_proprietario) ? ($imovel_atualiza->id_proprietario == $proprietario->id ? "selected" : "") : "" ?>><?= $proprietario->nome ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <div class="col-10 mb-3">
            <label for="rua" class="form-label">Endereço *:</label>
            <input type="text" class="form-control" id="rua" name="rua" value="<?= isset($imovel_atualiza->rua) ? $imovel_atualiza->rua : "" ?>" required>
        </div>
        <div class="col-2 mb-3">
            <label for="numero" class="form-label">Nº *:</label>
            <input type="text" class="form-control" id="numero" name="numero" value="<?= isset($imovel_atualiza->numero) ? $imovel_atualiza->numero : "" ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <label for="complemento" class="form-label">Complemento:</label>
            <input type="text" class="form-control" id="complemento" name="complemento" value="<?= isset($imovel_atualiza->complemento) ? $imovel_atualiza->complemento : "" ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <label for="cep" class="form-label">CEP *:</label>
            <input type="number" class="form-control" id="cep" name="cep" value="<?= isset($imovel_atualiza->cep) ? $imovel_atualiza->cep : "" ?>" required>
        </div>
        <div class="col-6 mb-3">
            <label for="estado" class="form-label">Estado *:</label>
            <input type="text" class="form-control" id="estado" name="estado" value="<?= isset($imovel_atualiza->estado) ? $imovel_atualiza->estado : "" ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <label for="cidade" class="form-label">Cidade *:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="<?= isset($imovel_atualiza->cidade) ? $imovel_atualiza->cidade : "" ?>" required>
        </div>
        <div class="col-6 mb-3">
            <label for="bairro" class="form-label">Bairro *:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="<?= isset($imovel_atualiza->bairro) ? $imovel_atualiza->bairro : "" ?>" required>
        </div>
    </div>
    <div class="mb-3">
        <a class="btn btn-warning mt-3" href="<?= URL ?>/imovel/listar" type="button" value="voltar">Voltar</a>
        <button class="btn btn-success float-end mt-3" type="submit"><?= isset($imovel_atualiza->id) ? "Alterar" : "Criar" ?></button>
    </div>
</form>