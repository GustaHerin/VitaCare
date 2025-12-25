<?php
session_start();
include_once("config.php");

if((!isset($_SESSION['email']) == true) || (!isset($_SESSION['senha']) == true)) {
    header('location: ../HTML/login.php');
    exit;
}

if(isset($_POST['submit_agendamento'])) {

    $email_usuario = $_SESSION['email'];

    $sql_busca_nome = "SELECT nome FROM usuarios WHERE email = '$email_usuario' LIMIT 1";
    $result_busca = mysqli_query($conexao, $sql_busca_nome);

    if($dados = mysqli_fetch_assoc($result_busca)) {
        $nome = mysqli_real_escape_string($conexao, $dados['nome']);
    } else {
        $nome = "Usuário Desconhecido";
    }

    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao_usuario']);
    $especialidade = mysqli_real_escape_string($conexao, $_POST['especialidade']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $grau = mysqli_real_escape_string($conexao, $_POST['grau']);
    $meios = mysqli_real_escape_string($conexao, $_POST['meios']);
    $periodo = mysqli_real_escape_string($conexao, $_POST['periodo']);

    $sql = "INSERT INTO agendamentos (nome, email_usuario, descricao, especialidade, cidade, grau_urgencia, tipo_atendimento, periodo) 
            VALUES ('$nome', '$email_usuario', '$descricao', '$especialidade', '$cidade', '$grau', '$meios', '$periodo')";

    if(mysqli_query($conexao, $sql)) {
        echo "<script>
                alert('Agendamento realizado com sucesso, $nome_usuario!');
                window.location.href='../HTML/home.php';
              </script>";
    } else {
        echo "Erro ao agendar: " . mysqli_error($conexao);
    }

} else {
    header('location: ../HTML/home.php');
}
?>