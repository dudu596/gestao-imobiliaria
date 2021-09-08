<?php

if (isset($_POST)) {

    $imovel = new Imovel;
    $retorno = $imovel->getImovelByProprietario($_POST['id_proprietario']);

    echo json_encode($retorno);
}
