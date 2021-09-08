<?php

class Contrato extends Connection
{

    public function getAllContrato()
    {
        $sql = "SELECT im.rua, im.numero, im.bairro, im.cidade, cl.nome, co.* FROM contrato co LEFT JOIN cliente cl on co.id_cliente = cl.id LEFT JOIN imovel im on co.id_imovel = im.id";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function insertContrato($array_parametros)
    {

        $sql = "INSERT INTO contrato (id_imovel, id_cliente, data_inicio, data_fim, taxa_administracao, valor_aluguel, valor_condominio, valor_iptu) VALUES (:id_imovel, :id_cliente, :data_inicio, :data_fim, :taxa_administracao, :valor_aluguel, :valor_condominio, :valor_iptu)";
        
        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $this->db->lastInsertId();
    }

    public function getContrato($id)
    {
        $array_parametros['id'] = $id;
        $sql = "SELECT * FROM contrato WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetch();
    }

    public function updateContrato($array_parametros)
    {
        $sql = "UPDATE contrato SET id_imovel = :id_imovel, id_cliente = :id_cliente, data_inicio = :data_inicio, data_fim = :data_fim, taxa_administracao = :taxa_administracao, valor_aluguel = :valor_aluguel, valor_condominio = :valor_condominio, valor_iptu = :valor_iptu WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }

    public function deleteContrato($id)
    {
        $array_parametros['id'] = $id;
        $sql = "DELETE FROM contrato WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }
}
