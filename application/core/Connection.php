<?php

class Connection
{

    public $db = null;

    private $db_type = "mysql";
    private $db_charset = "utf8";
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "gestao_imobiliaria";

    function __construct()
    {
        try {

            $this->openDatabaseConnection();
        } catch (\PDOException $e) {

            exit('Sem conexão com o Banco de Dados.');
        }
    }

    private function openDatabaseConnection()
    {

        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(
            $this->db_type .
            ':host=' . $this->db_host .
            ';dbname=' . $this->db_name .
            ';charset=' . $this->db_charset,
            $this->db_user,
            $this->db_password,
            $options
        );
    }
}
