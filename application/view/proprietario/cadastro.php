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
        <label for="nome" class="form-label">Nome *:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($proprietario_atualiza->telefone) ? $proprietario_atualiza->nome : "" ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-Mail *:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= isset($proprietario_atualiza->telefone) ? $proprietario_atualiza->email : "" ?>" required>
    </div>
    <div class="row">
        <div class="col-9 mb-3">
            <label for="telefone" class="form-label">Telefone *:</label>
            <input type="number" class="form-control" id="telefone" name="telefone" value="<?= isset($proprietario_atualiza->telefone) ? $proprietario_atualiza->telefone : "" ?>" required>
        </div>
        <div class="col-3 mb-3">
            <label for="dia_repasse" class="form-label">Dia do Repasse *:</label>
            <input type="number" class="form-control" maxlenght="2" id="dia_repasse" name="dia_repasse" value="<?= isset($proprietario_atualiza->dia_repasse) ? $proprietario_atualiza->dia_repasse : "" ?>" required>
        </div>
    </div>
    <a class="btn btn-warning mt-3" href="<?= URL ?>/proprietario/listar" type="button" value="voltar">Voltar</a>
    <button class="btn btn-success float-end mt-3" type="submit"><?= isset($proprietario_atualiza->id) ? "Alterar" : "Criar" ?></button>
</form>