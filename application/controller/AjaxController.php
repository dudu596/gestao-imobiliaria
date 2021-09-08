<?php

class AjaxController
{

    public function imovel()
    {
        require_once APP . "model/Imovel.php";
        require_once APP . "ajax/imovel.php";
    }
}
