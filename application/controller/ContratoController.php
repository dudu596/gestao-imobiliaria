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
        $array_contratos = $objeto_contrato->getAll();
        require_once APP . "view/contrato/listar.php";
    }

    public function cadastro($id = 0)
    {
        $contrato = new Contrato;
        $objeto_proprietario = new Proprietario;
        $objeto_cliente = new Cliente;
        $array_proprietario = $objeto_proprietario->getAll();
        $array_cliente = $objeto_cliente->getAll();
        if (isset($_POST['erro'])) {
            unset($_POST);
        }
        if (!empty($_POST)) {
            $array_campos = ["id_imovel", "id_cliente", "data_inicio", "data_fim", "taxa_administracao", "valor_aluguel", "valor_condominio", "valor_iptu"];
            $array_tipo =   ["numerico", "numerico", "data", "data", "numerico", "numerico", "numerico", "numerico"];
            if (verificaPost($_POST, $array_campos, $array_tipo)) {
                if (validaNumero($id)) {
                    $_POST['id'] = $id;
                    $contrato->update($_POST);
                } else {
                    $id_mensalidade = $contrato->insert($_POST);
                    $this->gerar($id_mensalidade);
                }
                header("Location: " . URL . "/contrato/listar");
                exit;
            }
            if (validaNumero($id)) {
                header("Location: " . URL . "/contrato/cadastro/{$id}?erro=" . $_POST['erro']);
                exit;
            }
            header("Location: " . URL . "/contrato/cadastro?erro=" . $_POST['erro']);
            exit;
        }

        $titulo = "CADASTRO DE CONTRATO";
        if (validaNumero($id)) {
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
            $contrato->delete($id);
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

        unset($data_inicio);
        unset($data_fim);

        $quantidade_meses = (($ano_fim - $ano_inicio) * 12) + ($mes_fim - $mes_inicio) + 1;
        $quantidade_pagos = $mensalidade->getCountPagos($id)->total;
        $ultima = true;
        if ($quantidade_meses > (12 + $quantidade_pagos)) {
            $quantidade_meses = 12 + $quantidade_pagos;
            $ultima = false;
        }

        $array_meses = $mensalidade->getMeses($id);
        for ($i = 1; $i <= $quantidade_meses; $i++) {

            switch ($mes_inicio) {
                case 4:
                case 6:
                case 9:
                case 11:
                    $dias_mes = 30;
                    break;
                case 2:
                    $dias_mes = 28;
                    break;
                default:
                    $dias_mes = 31;
                    break;
            }
            $porcentagem_inicio = ($dias_mes - $dia_inicio + 1) / $dias_mes;
            $porcentagem_fim = $dia_fim / $dias_mes;

            $mes_inicio++;
            if ($mes_inicio < 10) {
                $mes_inicio = "0" . $mes_inicio;
            }
            if ($mes_inicio > 12) {
                $mes_inicio = "01";
                $ano_inicio++;
            }

            $array_parametros['mes'] = $ano_inicio . "-" . $mes_inicio . "-01";

            if (!in_array($array_parametros['mes'], $array_meses)) {
                $array_parametros['id_contrato'] = $contrato->id;
                $array_parametros['mensalidade_paga'] = 0;
                $array_parametros['repasse_realizado'] = 0;

                if ($i === 1) {
                    $this->calcularMensalidade($array_parametros, $contrato, $porcentagem_inicio);
                } else if ($i == $quantidade_meses && $ultima) {
                    $this->calcularMensalidade($array_parametros, $contrato, $porcentagem_fim);
                } else {
                    $this->calcularMensalidade($array_parametros, $contrato);
                }
                $mensalidade->insert($array_parametros);
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
    private function calcularMensalidade(&$array_parametros, $contrato, $porcentagem_cobrado = 1)
    {
        $valor_aluguel = $contrato->valor_aluguel * $porcentagem_cobrado;
        $valor_condominio = $contrato->valor_condominio * $porcentagem_cobrado;
        $valor_iptu = $contrato->valor_iptu * $porcentagem_cobrado;
        $taxa_administracao = $contrato->taxa_administracao * $porcentagem_cobrado;

        $array_parametros['mensalidade'] = $valor_aluguel + $valor_condominio + $valor_iptu;
        $array_parametros['repasse'] = $valor_aluguel + $valor_iptu - $taxa_administracao;
        return true;
    }
}
