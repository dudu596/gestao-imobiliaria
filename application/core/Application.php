<?php

require_once APP . "core/config.php";
require_once APP . "core/util.php";
require_once APP . "core/Connection.php";



class Application
{

    public function __construct()
    {
        $nome_tela = "Gestão Imobiliária";
        $nome_controller = "Home";
        $nome_metodo = "index";
        $parametros = [];

        if (!empty($_GET['url'])) {

            $url = explode("/", trim($_GET['url'], "/"));
            $nome_controller = ($url[0] ? ucfirst($url[0]) : $nome_controller) . "Controller";
            $nome_tela = "[" . ($url[0] ? ucfirst($url[0]) : "Home") . "] - " . $nome_tela;
            if(isset($url[1])){
                $nome_metodo = $url[1];
                unset($url[0]);
                unset($url[1]);
                $parametros = array_values($url);   
            }
            $controller_caminho = APP . "controller/" . $nome_controller . ".php";
            if (file_exists($controller_caminho)) {
                require_once $controller_caminho;
                $controller = new $nome_controller;
            } else {
                require_once APP . "controller/ErrorController.php";
                $controller = new ErrorController;
            }
        } else {
            require_once APP . "controller/HomeController.php";
            $controller = new HomeController;
        }

        if($nome_controller == "AjaxController"){
            call_user_func_array([$controller, $nome_metodo],$parametros);
        }else{
            require_once APP . "view/__template/header.php";
            call_user_func_array([$controller, $nome_metodo],$parametros);
            require_once APP . "view/__template/footer.php";
        }
    }
}
