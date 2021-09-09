<?php

class Model extends Connection
{
    private $tabela;

    public function __construct()
    {
        parent::__construct();
    }

    public function setTabela($tabela)
    {
        $this->tabela = $tabela;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->tabela}";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function insert($array_parametros)
    {
        $sql_colunas = "";
        $sql_parametros = "";

        $colunas = array_keys($array_parametros);
        foreach ($colunas as $coluna) {
            $sql_colunas .= $coluna . ", ";
            $sql_parametros .= ":" . $coluna . ", ";
        }

        $sql = "INSERT INTO {$this->tabela} (" . trim($sql_colunas, ", ") . ") VALUES (" . trim($sql_parametros, ", ") . ")";
        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
        
        return $this->db->lastInsertId();
    }

    public function getById($id)
    {
        $array_parametros['id'] = $id;
        $sql = "SELECT * FROM {$this->tabela} WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);

        return $query->fetch();
    }

    public function update($array_parametros)
    {
        $sql_parametros = "";

        $colunas = array_keys($array_parametros);
        foreach ($colunas as $coluna) {
            $sql_parametros .= $coluna . " = :" . $coluna . ", ";
        }

        $sql = "UPDATE {$this->tabela} SET " . trim($sql_parametros, ", ") . "WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }

    public function delete($id)
    {
        $array_parametros['id'] = $id;
        $sql = "DELETE FROM {$this->tabela} WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute($array_parametros);
    }
}
