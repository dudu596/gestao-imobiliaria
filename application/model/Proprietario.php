<?php
require_once APP . "model/Model.php";
class Proprietario extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTabela("proprietario");
    }
}
