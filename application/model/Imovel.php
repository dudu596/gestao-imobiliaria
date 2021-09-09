<?php
require_once APP . "model/Model.php";
class Imovel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTabela("imovel");
    }

    public function getAll()
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

}
