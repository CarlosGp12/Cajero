<?php
function conectarDB()
{
    $db = mysqli_connect('localhost', 'root', 'root', 'cajero');
    if(!$db){
        echo "Error no se conecto";
        exit;
    }

    return $db;
}
