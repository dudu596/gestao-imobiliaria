<?php

class Proprietario extends Connection
{

    public function getAllProprietario()
    {
        $sql = "SELECT * FROM proprietario";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function insertProprietario($array_parametros)
    {
        $sql = "INSERT INTO proprietario (nome, email, telefone, dia_repasse) VALUES (:nome, :email, :telefone, :dia_repasse)";
        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $this->db->lastInsertId();
    }

    public function getProprietario($id)
    {
        $array_parametros['id'] = $id;
        $sql = "SELECT * FROM proprietario WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetch();
    }

    public function updateProprietario($array_parametros)
    {
        $sql = "UPDATE proprietario SET nome = :nome, email = :email, telefone = :telefone, dia_repasse = :dia_repasse WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }

    public function deleteProprietario($id)
    {
        $array_parametros['id'] = $id;
        $sql = "DELETE FROM proprietario WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }
}
