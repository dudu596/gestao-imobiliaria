<?php

function echod($parametros, $die = true)
{
    echo "<pre>";
    print_r($parametros);
    echo "</pre>";

    if ($die){
        exit;
    }
}