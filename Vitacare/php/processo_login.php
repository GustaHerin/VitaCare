<?php
session_start();

if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){

    include_once("config.php");

    $email = $conexao->real_escape_string($_POST["email"]);
    $senha = $_POST["senha"];


    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conexao->query($sql);

    // Verifica se achou o email
    if($result->num_rows < 1){
        // Email não existe
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: ../html/login.php?erro=usuario_nao_encontrado');
    }
    else {

        $usuario = $result->fetch_assoc();

        if(password_verify($senha, $usuario['senha'])) {

            // SENHA CORRETA!
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;

            header('Location: ../html/home.php');
        }
        else {

            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: ../html/login.php?erro=senha_incorreta');
        }
    }
}
else {
    // Acesso direto proibido
    header('Location: ../html/login.php');
}
?>