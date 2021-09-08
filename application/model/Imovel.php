<?php

class Imovel extends Connection
{

    public function getAllImovel()
    {
        $sql = "SELECT p.nome, i.* FROM imovel i LEFT JOIN proprietario p on p.id = i.id_proprietario";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getImovelByProprietario($id_proprietario)
    {
        $array_parametros['id_proprietario'] = $id_proprietario;
        $sql = "SELECT * FROM imovel WHERE id_proprietario = :id_proprietario";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetchAll();
    }

    public function insertImovel($array_parametros)
    {
        $sql = "INSERT INTO imovel (id_proprietario, rua, numero, complemento, bairro, cidade, estado, cep) VALUES (:id_proprietario, :rua, :numero, :complemento, :bairro, :cidade, :estado, :cep)";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $this->db->lastInsertId();
    }

    public function getImovel($id)
    {
        $array_parametros['id'] = $id;
        $sql = "SELECT * FROM imovel WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetch();
    }

    public function updateImovel($array_parametros)
    {
        $sql = "UPDATE imovel SET id_proprietario = :id_proprietario, rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return true;
    }

    public function deleteImovel($id)
    {
        $array_parametros['id'] = $id;
        $sql = "DELETE FROM imovel WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return true;
    }
}
