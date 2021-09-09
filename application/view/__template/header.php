<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nome_tela ?></title>
    <link href="<?= URL ?>/public/css/styles.css" rel="stylesheet" />
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">Gestão Imobiliária</div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= URL ?>/">Início</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= URL ?>/cliente/">Clientes</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= URL ?>/proprietario/">Proprietários</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= URL ?>/imovel/">Imóveis</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= URL ?>/contrato/">Contratos</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <div class="container-fluid mt-4">
                <div class="container justify-content-center col-9 bg-light p-3 rounded" style="min-height: 50vh">