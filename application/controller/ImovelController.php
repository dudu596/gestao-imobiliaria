<?php
require_once APP . "model/Imovel.php";
require_once APP . "model/Proprietario.php";
class ImovelController
{

    public function index()
    {
        header("Location: " . URL . "/imovel/listar");
    }

    public function listar()
    {
        $objeto_imovel = new Imovel;
        $array_imoveis = $objeto_imovel->getAllImovel();
        require_once APP . "view/imovel/listar.php";
    }

    public function cadastro($id = 0)
    {
        $imovel = new Imovel;
        $objeto_proprietario = new Proprietario;
        $array_proprietario = $objeto_proprietario->getAllProprietario();
        if (!empty($_POST)) {
            if (!empty($_POST['rua'])) {
                if ($id) {
                    $_POST['id'] = $id;
                    $imovel->updateImovel($_POST);
                } else {
                    $imovel->insertImovel($_POST);
                }
                header("Location: " . URL . "/imovel/listar");
            }
        }
        unset($_POST);
        $titulo = "CADASTRO DE IMOVEL";
        if ($id) {
            $imovel_atualiza = $imovel->getImovel($id);
            $titulo = "ALTERAR - " . $titulo;
        } else {
            $titulo = "CRIAR - " . $titulo;
        }


        require_once APP . "view/imovel/cadastro.php";
    }

    public function apagar($id)
    {
        $imovel = new Imovel;

        if (is_numeric($id)) {
            $imovel->deleteImovel($id);
        }
        header("Location: " . URL . "/imovel/listar");
    }
}
