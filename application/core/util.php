<?php

function echod($parametros, $die = true)
{
    echo "<pre>";
    var_dump($parametros);
    echo "</pre>";

    if ($die) {
        exit;
    }
}

function validaEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function validaNumero($numero)
{
    if (is_numeric($numero) && $numero != 0) {
        return true;
    }
    return false;
}

function validaData($data)
{
    $array = explode("-", $data);
    if (checkdate($array[1], $array[2], $array[0])) {
        return true;
    }
    return false;
}

function valida($parametro, $tipo)
{
    switch ($tipo) {
        case "string_null":
        case "string":
            return true;
        case "email":
            return validaEmail($parametro);
        case "numerico":
            return validaNumero($parametro);
        case "data":
            return validaData($parametro);
    }
}

function verificaPost(&$post, $chaves, $tipos)
{
    $valida_1 = 0;
    $valida_2 = 0;
    $erro = "";
    $success = true;
    $post_keys = array_keys($post);

    foreach ($chaves as $k => $chave) {
        $valida_1++;
        if (array_search($chave, $post_keys) !== false) {
            if (!empty($post[$chave]) || $tipos[$k] == "string_null") {
                if (valida($post[$chave], $tipos[$k])) {
                    $new_post[$chave] = $post[$chave];
                    $valida_2++;
                }
            }
        }
        if ($valida_1 != $valida_2) {
            $valida_2 = $valida_1;
            $erro .= str_replace("id_", "", $chave) . "-";
            $success = false;
        }
    }
    if ($success) {
        $post = $new_post;
        return true;
    }
    $post = ["erro" => trim($erro,"-")];
    return false;
}
