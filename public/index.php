<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
define('URL', "/" . explode("/", trim($_SERVER['REQUEST_URI'], "/"))[0]);

require_once APP . "core/Application.php";

$app = new Application();
