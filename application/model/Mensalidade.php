<?php

class Mensalidade extends Contrato
{
    public function __construct()
    {
        Model::__construct();
        $this->setTabela("mensalidade");
    }

    public function getMensalidadeByContrato($id_contrato)
    {
        $array_parametros['id_contrato'] = $id_contrato;
        $sql = "SELECT case when mes < sysdate() then 1 else 0 end as pagamento_atrasado, case when date_sub(DATE_ADD(mes, INTERVAL pr.dia_repasse day),INTERVAL 1 day) < sysdate() then 1 else 0 end as repasse_atrasado, m.* FROM mensalidade m left join contrato co on co.id = m.id_contrato left join imovel im on im.id = co.id_imovel left join proprietario pr on pr.id = im.id_proprietario WHERE id_contrato = :id_contrato ORDER BY mes";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetchAll();
    }

    public function getMeses($id_contrato)
    {
        $array_parametros['id_contrato'] = $id_contrato;
        $sql = "SELECT DISTINCT mes FROM mensalidade WHERE id_contrato = :id_contrato ORDER BY mes ASC";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public function statusMensalidade($id, $status = 1)
    {
        $array_parametros['id'] = $id;
        $array_parametros['status'] = $status;
        $sql = "UPDATE mensalidade SET mensalidade_paga = :status WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }

    public function statusRepasse($id, $status = 1)
    {
        $array_parametros['id'] = $id;
        $array_parametros['status'] = $status;
        $sql = "UPDATE mensalidade SET repasse_realizado = :status WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }

    public function getCountPagos($id_contrato)
    {~
        $array_parametros['id_contrato'] = $id_contrato;
        $sql = "SELECT count(*) as total FROM mensalidade WHERE id_contrato = :id_contrato AND mensalidade_paga = 1 AND repasse_realizado = 1";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetch();
    }
}
