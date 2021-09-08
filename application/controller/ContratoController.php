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
                $this->gerar($id);
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
        $array_mensalidades = $mensalidade->getMensalidadeByContrato($id);
        require_once APP . "view/contrato/mensalidade.php";
    }

    public function gerar($id)
    {
        $mensalidade = new Mensalidade;
        $contrato = $mensalidade->getContrato($id);

        $data_inicio = strtotime($contrato->data_inicio);
        $data_fim = strtotime($contrato->data_fim);

        $ano_inicio = date('Y', $data_inicio);
        $ano_fim = date('Y', $data_fim);

        $mes_inicio = date('m', $data_inicio);
        $mes_fim = date('m', $data_fim);

        $dia_inicio = date('d', $data_inicio);
        $dia_fim = date('d', $data_fim);

        $quantidade_meses = (($ano_fim - $ano_inicio) * 12) + ($mes_fim - $mes_inicio);

        if ($quantidade_meses > 12) {
            $quantidade_meses = 12;
        }

        $array_meses = $mensalidade->getMeses($id);
        for ($i = 0; $i < $quantidade_meses; $i++) {

            switch ($mes_inicio) {
                case 4:
                case 6:
                case 9:
                case 11:
                    $dias_mes = 31;
                    break;
                case 2:
                    $dias_mes = 28;
                    break;
                default:
                    $dias_mes = 30;
                    break;
            }
            $ano_inicio;

            $mes_inicio++;
            if ($mes_inicio < 10) {
                $mes_inicio = "0" . $mes_inicio;
            }
            if ($mes_inicio > 12) {
                $mes_inicio = "01";
                $ano_inicio++;
            }
            $array_parametros['mes'] = $ano_inicio . "-" . $mes_inicio . "-01";
            // verificar data para calculo de mensalidade
            if (!in_array($array_parametros['mes'], $array_meses)) {
                $array_parametros['id_contrato'] = $contrato->id;
                $array_parametros['mensalidade'] = $contrato->valor_aluguel + $contrato->valor_condominio + $contrato->valor_iptu;
                $array_parametros['repasse'] = $contrato->valor_aluguel + $contrato->valor_iptu - $contrato->taxa_administracao;
                $array_parametros['mensalidade_paga'] = 0;
                $array_parametros['repasse_realizado'] = 0;
                $mensalidade->insertMensalidade($array_parametros);
            }
        }

        header("Location: " . URL . "/contrato/mensalidade/" . $id);
    }
    public function mensalidadePaga($id, $id_contrato)
    {
        $mensalidade = new Mensalidade;
        $array_mensalidades = $mensalidade->statusMensalidade($id);
        header("Location: " . URL . "/contrato/mensalidade/" . $id_contrato);
    }
    public function repasseRealizado($id, $id_contrato)
    {
        $mensalidade = new Mensalidade;
        $array_mensalidades = $mensalidade->statusRepasse($id);
        header("Location: " . URL . "/contrato/mensalidade/" . $id_contrato);
    }
    public function mensalidadeCancelada($id, $id_contrato)
    {
        $mensalidade = new Mensalidade;
        $array_mensalidades = $mensalidade->statusMensalidade($id, 0);
        header("Location: " . URL . "/contrato/mensalidade/" . $id_contrato);
    }
    public function repasseCancelado($id, $id_contrato)
    {
        $mensalidade = new Mensalidade;
        $array_mensalidades = $mensalidade->statusRepasse($id, 0);
        header("Location: " . URL . "/contrato/mensalidade/" . $id_contrato);
    }
}
