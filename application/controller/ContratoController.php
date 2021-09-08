<?php
require_once APP . "model/Contrato.php";
require_once APP . "model/Proprietario.php";
require_once APP . "model/Cliente.php";
require_once APP . "model/Mensalidade.php";
class ContratoController
{

    public function index()
    {
        header("Location: " . URL . "/contrato/listar");
    }

    public function listar()
    {
        $objeto_contrato = new Contrato;
        $array_contratos = $objeto_contrato->getAllContrato();
        require_once APP . "view/contrato/listar.php";
    }

    public function cadastro($id = 0)
    {
        $contrato = new Contrato;
        $objeto_proprietario = new Proprietario;
        $objeto_cliente = new Cliente;
        $array_proprietario = $objeto_proprietario->getAllProprietario();
        $array_cliente = $objeto_cliente->getAllCliente();

        if (!empty($_POST)) {
            if (!empty($_POST['id_imovel'])) {
                unset($_POST["id_proprietario"]);
                if ($id) {
                    $_POST['id'] = $id;
                    $contrato->updateContrato($_POST);
                } else {
                    $contrato->insertContrato($_POST);
                }
                unset($_POST);
                header("Location: " . URL . "/contrato/listar");
            }
        }
        $titulo = "CADASTRO DE CONTRATO";
        if ($id) {
            $contrato_atualiza = $contrato->getContrato($id);
            $titulo = "ALTERAR - " . $titulo;
        } else {
            $titulo = "CRIAR - " . $titulo;
        }
        require_once APP . "view/contrato/cadastro.php";
    }

    public function apagar($id)
    {
        $contrato = new Contrato;

        if (is_numeric($id)) {
            $contrato->deleteContrato($id);
        }
        header("Location: " . URL . "/contrato/listar");
    }

    public function mensalidade($id)
    {
        $mensalidade = new Mensalidade;
        $array_mensalidades = $mensalidade->getAllMensalidade();
        require_once APP . "view/contrato/mensalidade.php";
    }

    public function gerar($id)
    {
        $mensalidade = new Mensalidade;
        $array_parametros = $mensalidade->getContrato($id);
        echod(strtotime($array_parametros->data_fim) - strtotime($array_parametros->data_inicio));

        // $array_parametros = 
        $mensalidade->insertMensalidade($array_parametros);
        header("Location: " . URL . "/contrato/mensalidade/". $id);
    }
}
