<?php
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "Gushennov#2014";
$dbName     = "vitacare_sys";
$dbPort     = 3308;

mysqli_report(MYSQLI_REPORT_OFF);

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName, $dbPort);

if ($conexao->connect_error) {
    die("Falha fatal na conexão com o banco de dados: " . $conexao->connect_error);
}
