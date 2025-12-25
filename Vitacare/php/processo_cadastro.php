<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../php/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
    $data_n = mysqli_real_escape_string($conexao, $_POST['data_n']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha_plana = $_POST['senha'];
    $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
    $tipo = mysqli_real_escape_string($conexao, $_POST['tipo']);

    $senha_hash = password_hash($senha_plana, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, telefone, cpf, data_n, email, senha, estado, tipo) 
            VALUES ('$nome', '$telefone', '$cpf', '$data_n', '$email', '$senha_hash', '$estado', '$tipo')";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        header("Location: ../HTML/cadastro.php?status=success");
    } else {

        if (mysqli_errno($conexao) == 1062) {
            header("Location: ../HTML/cadastro.php?status=error&code=1062");
        } else {

            header("Location: ../HTML/cadastro.php?status=error&code=db_fail");
        }
    }

    mysqli_close($conexao);
    exit();
} else {

    header("Location: ../HTML/cadastro.php");
    exit();
}
?>
