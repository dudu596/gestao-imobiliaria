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
        $array_proprietarios = $objeto_proprietario->getAll();
        require_once APP . "view/proprietario/listar.php";
    }

    public function cadastro($id = 0)
    {
        $proprietario = new Proprietario;

        if (isset($_POST['erro'])) {
            unset($_POST);
        }
        if (!empty($_POST)) {
            $array_campos = ["nome", "email", "telefone", "dia_repasse"];
            $array_tipo =   ["string", "email", "numerico" , "numerico"];
            if (verificaPost($_POST, $array_campos, $array_tipo)) {
                if (validaNumero($id)) {
                    $_POST['id'] = $id;
                    $proprietario->update($_POST);
                } else {
                    $proprietario->insert($_POST);
                }
                header("Location: " . URL . "/proprietario/listar");
                exit;
            }
            if (validaNumero($id)) {
                header("Location: " . URL . "/proprietario/cadastro/{$id}?erro=" . $_POST['erro']);
                exit;
            }
            header("Location: " . URL . "/proprietario/cadastro?erro=" . $_POST['erro']);
            exit;
        }

        $titulo = "CADASTRO DE PROPRIETARIO";
        if (validaNumero($id)) {
            $proprietario_atualiza = $proprietario->getById($id);
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
            $proprietario->delete($id);
        }
        header("Location: " . URL . "/proprietario/listar");
    }
}
