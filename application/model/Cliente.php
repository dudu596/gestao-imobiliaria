<?php
require_once APP . "model/Model.php";

class Cliente extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTabela("cliente");
    }
}
