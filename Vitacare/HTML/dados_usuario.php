<?php
session_start();

include_once("../php/config.php");

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: ../HTML/login.php');
    exit();
}

$email_logado = $_SESSION['email'];

$sql = "SELECT * FROM usuarios WHERE email = '$email_logado' LIMIT 1";

$result = $conexao->query($sql);

$dados_user = [];

if($result && $result->num_rows > 0) {
    $dados_user = mysqli_fetch_assoc($result);
}

$BASE_URL = "/Vitacare";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/dados_usuario.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Usuário</title>
</head>

<body>

<header>
    <img src="../Img/logo_h.png" id="logo" alt="VitaCare">
    <h1 id="vit">VitaCare</h1>
</header>
<main>
    <div class="card">

        <h1 class="titulo">Dados do Usuário</h1>

        <form class="formulario" action="../php/atualizar_dados.php" method="POST">

            <div class="campo">
                <label>Nome Completo</label>
                <input type="text" name="nome" placeholder="Seu nome" 
                       value="<?php echo isset($dados_user['nome']) ? $dados_user['nome'] : ''; ?>">
            </div>

            <div class="campo">
                <label>Email</label>
                <input type="email" name="email" placeholder="Seu email" 
                       value="<?php echo isset($dados_user['email']) ? $dados_user['email'] : ''; ?>" readonly>
            </div>

            <div class="campo">
                <label>Telefone</label>
                <input type="tel" name="telefone" placeholder="(00) 00000-0000"
                       value="<?php echo isset($dados_user['telefone']) ? $dados_user['telefone'] : ''; ?>">
            </div>

            <div class="campo">
                <label>CPF</label>
                <input type="text" name="cpf" placeholder="000.000.000-00"
                       value="<?php echo isset($dados_user['cpf']) ? $dados_user['cpf'] : ''; ?>" readonly>
            </div>

            <div class="campo">
                <label>Data de Nascimento</label>
                <input type="date" name="data_n"
                       value="<?php echo isset($dados_user['data_n']) ? $dados_user['data_n'] : ''; ?>" readonly>
            </div>

            <div class="campo">
                <label>Endereço</label>
                <input type="text" name="endereco" placeholder="Rua, número, bairro...">
            </div>


            <button id="salvar" type="submit">Salvar Alterações</button>
            
            <script>
                document.getElementById("salvar").addEventListener("click", function(event) {
                    event.preventDefault();
                    window.location.href = "../HTML/home.php";
                });
            </script>

        </form>

    </div>

</main>

<footer>
    <p>© 2025 <span>VitaCare</span> — Todos os direitos reservados.</p>
</footer>

</body>
</html>