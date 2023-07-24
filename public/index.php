<?php

$pdo = null;

try {
    $pdo = new PDO('mysql:host=mysql;dbname=database', 'root', '123');
    echo "Conexão realizada com sucesso";
} catch (PDOException $e) {
    print $e->getMessage();
    die();
}

var_dump($pdo);
