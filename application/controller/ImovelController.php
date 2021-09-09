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
        $array_imoveis = $objeto_imovel->getAll();
        require_once APP . "view/imovel/listar.php";
    }

    public function cadastro($id = 0)
    {
        $imovel = new Imovel;
        $objeto_proprietario = new Proprietario;
        $array_proprietario = $objeto_proprietario->getAll();
        if (isset($_POST['erro'])) {
            unset($_POST);
        }
        if (!empty($_POST)) {
            $array_campos = ["id_proprietario", "rua", "numero", "complemento", "bairro", "cidade", "estado", "cep"];
            $array_tipo =   ["numerico", "string", "numerico", "string_null", "string", "string", "string", "numerico"];
            if (verificaPost($_POST, $array_campos, $array_tipo)) {
                if (validaNumero($id)) {
                    $_POST['id'] = $id;
                    $imovel->update($_POST);
                } else {
                    $imovel->insert($_POST);
                }
                header("Location: " . URL . "/imovel/listar");
                exit;
            }
            if (validaNumero($id)) {
                header("Location: " . URL . "/imovel/cadastro/{$id}?erro=" . $_POST['erro']);
                exit;
            }
            header("Location: " . URL . "/imovel/cadastro?erro=" . $_POST['erro']);
            exit;
        }

        $titulo = "CADASTRO DE IMOVEL";
        if (validaNumero($id)) {
            $imovel_atualiza = $imovel->getById($id);
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
            $imovel->delete($id);
        }
        header("Location: " . URL . "/imovel/listar");
    }
}
