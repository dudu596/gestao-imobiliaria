<?php
require_once APP . "model/Model.php";

class Contrato extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTabela("contrato");
    }

    public function getAll()
    {
        $sql = "SELECT im.rua, im.numero, im.bairro, im.cidade, cl.nome, co.* FROM contrato co LEFT JOIN cliente cl on co.id_cliente = cl.id LEFT JOIN imovel im on co.id_imovel = im.id";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getContrato($id)
    {
        $array_parametros['id'] = $id;
        $sql = "SELECT i.id_proprietario, c.* FROM contrato c left join imovel i on i.id = c.id_imovel WHERE c.id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetch();
    }
}
