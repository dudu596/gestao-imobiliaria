<?php

class Mensalidade extends Contrato
{

    public function getAllMensalidade()
    {
        $sql = "SELECT * FROM mensalidade";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function insertMensalidade($array_parametros)
    {
        $sql = "INSERT INTO mensalidade (id_contrato, mensalidade, repasse) VALUES (:id_contrato, :mensalidade, :repasse)";
        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $this->db->lastInsertId();
    }

    public function getMensalidade($id)
    {
        $array_parametros['id'] = $id;
        $sql = "SELECT * FROM mensalidade WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetch();
    }

    public function updateMensalidade($array_parametros)
    {
        $sql = "UPDATE mensalidade SET id_contrato = :id_contrato, mensalidade = :mensalidade, repasse = :repasse WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }

    public function deleteMensalidade($id)
    {
        $array_parametros['id'] = $id;
        $sql = "DELETE FROM mensalidade WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }
}
