<form action="" method="post">
    <hr />
    <h3 class="text-center m-3"><?= $titulo ?></h3>
    <div class="mb-3">
        <label for="nome" class="form-label">Nome *:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($cliente_atualiza->telefone) ? $cliente_atualiza->nome : "" ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-Mail *:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= isset($cliente_atualiza->telefone) ? $cliente_atualiza->email : "" ?>">
    </div>
    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone *:</label>
        <input type="text" class="form-control" maxlenght="11" id="telefone" name="telefone" value="<?= isset($cliente_atualiza->telefone) ? $cliente_atualiza->telefone : "" ?>">
    </div>
    <div class="mb-3">
        <a class="btn btn-warning mt-3" href="<?= URL ?>/cliente/listar" type="button" value="voltar">Voltar</a>
        <button class="btn btn-success float-end mt-3" type="submit"><?= isset($cliente_atualiza->id) ? "Alterar" : "Criar" ?></button>
    </div>
</form>