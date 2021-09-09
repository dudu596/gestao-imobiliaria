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
        $array_clientes = $objeto_cliente->getAll();
        require_once APP . "view/cliente/listar.php";
    }

    public function cadastro($id = 0)
    {
        $cliente = new Cliente;
        if (isset($_POST['erro'])) {
            unset($_POST);
        }
        if (!empty($_POST)) {
            $array_campos = ["nome", "email", "telefone"];
            $array_tipo =   ["string", "email", "numerico"];
            if (verificaPost($_POST, $array_campos, $array_tipo)) {
                if (validaNumero($id)) {
                    $_POST['id'] = $id;
                    $cliente->update($_POST);
                } else {
                    $cliente->insert($_POST);
                }
                header("Location: " . URL . "/cliente/listar");
                exit;
            }
            if (validaNumero($id)) {
                header("Location: " . URL . "/cliente/cadastro/{$id}?erro=" . $_POST['erro']);
                exit;
            }
            header("Location: " . URL . "/cliente/cadastro?erro=" . $_POST['erro']);
            exit;
        }

        $titulo = "CADASTRO DE CLIENTE";
        if (validaNumero($id)) {
            $cliente_atualiza = $cliente->getById($id);
            $titulo = "ALTERAR - " . $titulo;
        } else {
            $titulo = "CRIAR - " . $titulo;
        }

        require_once APP . "view/cliente/cadastro.php";
    }

    public function apagar($id)
    {
        $cliente = new Cliente;

        if (validaNumero($id)) {
            $cliente->delete($id);
        }
        header("Location: " . URL . "/cliente/listar");
    }
}
