<?php
require_once APP . "model/Proprietario.php";
class ProprietarioController
{

    public function index()
    {
        header("Location: " . URL . "/proprietario/listar");
    }

    public function listar()
    {
        $objeto_proprietario = new Proprietario;
        $array_proprietarios = $objeto_proprietario->getAllProprietario();
        require_once APP . "view/proprietario/listar.php";
    }

    public function cadastro($id = 0)
    {
        $proprietario = new Proprietario;

        if (!empty($_POST)) {
            if (!empty($_POST['nome'])) {
                if ($id) {
                    $_POST['id'] = $id;
                    $proprietario->updateProprietario($_POST);
                } else {
                    $proprietario->insertProprietario($_POST);
                }
                header("Location: " . URL . "/proprietario/listar");
            }
        }
        unset($_POST);
        $titulo = "CADASTRO DE PROPRIETARIO";
        if ($id) {
            $proprietario_atualiza = $proprietario->getProprietario($id);
            $titulo = "ALTERAR - " . $titulo;
        } else {
            $titulo = "CRIAR - " . $titulo;
        }


        require_once APP . "view/proprietario/cadastro.php";
    }

    public function apagar($id)
    {
        $proprietario = new Proprietario;

        if (is_numeric($id)) {
            $proprietario->deleteProprietario($id);
        }
        header("Location: " . URL . "/proprietario/listar");
    }
}
