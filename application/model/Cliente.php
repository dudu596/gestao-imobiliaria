<?php

class Cliente extends Connection
{

    public function getAllCliente()
    {
        $sql = "SELECT * FROM cliente";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function insertCliente($array_parametros)
    {
        $sql = "INSERT INTO cliente (nome, email, telefone) VALUES (:nome, :email, :telefone)";
        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $this->db->lastInsertId();
    }

    public function getCliente($id)
    {
        $array_parametros['id'] = $id;
        $sql = "SELECT * FROM cliente WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetch();
    }

    public function updateCliente($array_parametros)
    {
        $sql = "UPDATE cliente SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }

    public function deleteCliente($id)
    {
        $array_parametros['id'] = $id;
        $sql = "DELETE FROM cliente WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }
}
