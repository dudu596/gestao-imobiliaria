<?php
require_once APP . "model/Cliente.php";
class ClienteController
{

    public function index()
    {
        header("Location: " . URL . "/cliente/listar");
    }

    public function listar()
    {
        $objeto_cliente = new Cliente;
        $array_clientes = $objeto_cliente->getAllCliente();
        require_once APP . "view/cliente/listar.php";
    }

    public function cadastro($id = 0)
    {
        $cliente = new Cliente;

        if (!empty($_POST)) {
            if (!empty($_POST['nome'])) {
                if ($id) {
                    $_POST['id'] = $id;
                    $cliente->updateCliente($_POST);
                } else {
                    $cliente->insertCliente($_POST);
                }
                header("Location: " . URL . "/cliente/listar");
            }
        }
        unset($_POST);
        $titulo = "CADASTRO DE CLIENTE";
        if ($id) {
            $cliente_atualiza = $cliente->getCliente($id);
            $titulo = "ALTERAR - " . $titulo;
        } else {
            $titulo = "CRIAR - " . $titulo;
        }


        require_once APP . "view/cliente/cadastro.php";
    }

    public function apagar($id)
    {
        $cliente = new Cliente;

        if (is_numeric($id)) {
            $cliente->deleteCliente($id);
        }
        header("Location: " . URL . "/cliente/listar");
    }
}
