<?php
session_start();

if((!isset($_SESSION['email']) == true) || (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('location: login.php');
    exit;
}

include_once("../php/config.php");

$email_logado = $_SESSION['email'];

$sql_user = "SELECT nome FROM usuarios WHERE email = '$email_logado'";
$result_user = $conexao->query($sql_user);
$dados_user = $result_user->fetch_assoc();

$nome_usuario = isset($dados_user['nome']) ? $dados_user['nome'] : "Usuário";

$BASE_URL = "/Vitacare";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/sty_home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

<main>

    <header>
        <img src="../Img/logo_h.png" id="logo" alt="VitaCare">
        <h1 id="vit">VitaCare</h1>

        <div class="pontos">
            <input type="checkbox" id="box">
            <label for="box">
                <span id="span1"></span>
                <span id="span2"></span>
                <span id="span3"></span>
            </label>

            <br><br>

            <div id="oculto">
                <button id="login-u" type="button" onclick="window.location.href='../HTML/dados_usuario.php'"><p>Dados do Usuario</p></button><br>
                <button id="login-h" type="button" onclick="window.location.href='../HTML/historico.html'"><p>Historico de Consultas</p></button><br>
                <button id="login-s" type="button" onclick="window.location.href='../html/sobre.html'"><p>Sobre Nos</p></button><br>
                <button id="login-l" type="button" onclick="window.location.href='../php/sair.php'"><p>Sair</p></button>
            </div>
        </div>
    </header>

    <h1 id="bem"><b><i>Bem vindo <?php echo $nome_usuario; ?>, a sua área médica!</i></b></h1>
    <br><br>

    <form id="content-container" action="../php/processa_agendamento.php" method="POST">

        <div id="descri">
            <h1 id="h1des"><b><i>Descreva seus sintomas</i></b></h1>

            <textarea name="descricao_usuario" id="des" required minlength="10" placeholder="Descreva aqui o que você está sentindo..."></textarea>

        </div>

        <div id="agenda">

            <h1><b><i>Agende agora sua consulta</i></b></h1>
            <br>
            <h3><b><i>Mais de 1 mil especialistas de saúde estão preparados para te ajudar</i></b></h3>

            <div id="escolhas">

                <div class="escolha">
                    <select name="especialidade" id="esp" required>
                        <option value="">Especialidade Médica</option>
                        <option value="Cardiologia">Cardiologia</option>
                        <option value="Cirurgião Geral">Cirurgião Geral</option>
                        <option value="Médico Geral">Médico Geral</option>
                        <option value="Dermatologia">Dermatologia</option>
                        <option value="Endocrinologia">Endocrinologia</option>
                        <option value="Gastroenterologia">Gastroenterologia</option>
                        <option value="Geriatria">Geriatria</option>
                        <option value="Ginecologia">Ginecologia</option>
                        <option value="Ginecologia/Obstetrícia (pré-natal)">Ginecologia/Obstetrícia (pré-natal)</option>
                        <option value="Mastologia">Mastologia</option>
                        <option value="Hematologia">Hematologia</option>
                        <option value="Nutrição">Nutrição</option>
                        <option value="Odontologia">Odontologia</option>
                        <option value="Oftalmologia">Oftalmologia</option>
                        <option value="Ortopedia">Ortopedia</option>
                        <option value="Otorrinolaringologia">Otorrinolaringologia</option>
                        <option value="Pediatria">Pediatria</option>
                        <option value="Pneumologia">Pneumologia</option>
                        <option value="Psiquiatria">Psiquiatria</option>
                        <option value="Reumatologia">Reumatologia</option>
                        <option value="Urologia">Urologia</option>
                        <option value="Neurologia">Neurologia</option>
                        <option value="Oncologia">Oncologia</option>
                        <option value="Nefrologia">Nefrologia</option>
                        <option value="Anestesiologia">Anestesiologia</option>
                        <option value="Radiologia">Radiologia</option>
                        <option value="Cirurgia Plástica">Cirurgia Plástica</option>
                        <option value="Cirurgia Vascular">Cirurgia Vascular</option>
                        <option value="Infectologia">Infectologia</option>
                        <option value="Medicina do Trabalho">Medicina do Trabalho</option>
                        <option value="Medicina Esportiva">Medicina Esportiva</option>
                        <option value="Medicina Intensiva">Medicina Intensiva</option>
                        <option value="Medicina da Família e Comunidade">Medicina da Família e Comunidade</option>
                        <option value="Cardiologia Pediátrica">Cardiologia Pediátrica</option>
                        <option value="Cirurgia Pediátrica">Cirurgia Pediátrica</option>
                        <option value="Neonatologia">Neonatologia</option>
                        <option value="Fonoaudiologia">Fonoaudiologia</option>
                        <option value="Fisioterapia">Fisioterapia</option>
                        <option value="Psicologia">Psicologia</option>
                        <option value="Terapia Ocupacional">Terapia Ocupacional</option>
                    </select>
                </div>

                <div class="escolha">
                    <select name="cidade" id="cid" required>
                        <option value="">Cidade</option>
                        <option value="Goianira">Goianira</option>
                        <option value="Goiania">Goiania</option>
                        <option value="Inhumas">Inhumas</option>
                        <option value="Caturai">Caturai</option>
                        <option value="Brasilia">Brasilia</option>
                    </select>
                </div>

                <div class="escolha">
                    <select name="grau" id="gra" required>
                        <option value="">Grau de Urgência</option>
                        <option value="Emergência">Emergência (risco imediato)</option>
                        <option value="Muito urgente">Muito urgente</option>
                        <option value="Urgente">Urgente</option>
                        <option value="Pouco urgente">Pouco urgente</option>
                        <option value="Não urgente">Não urgente</option>
                    </select>
                </div>

                <div class="escolha">
                    <select name="meios" id="me" required>
                        <option value="">Tipo de Atendimento</option>
                        <option value="Particular">Particular</option>
                        <option value="Convenio">Convênio</option>
                        <option value="SUS">SUS</option>
                    </select>
                </div>

                <div class="escolha01">
                    <select name="periodo" id="perio" required>
                        <option value="">Período de Preferência</option>
                        <option value="manha">Manhã (8h - 12h)</option>
                        <option value="tarde">Tarde (12h - 17h)</option>
                        <option value="noite">Noite (17h - 20h)</option>
                    </select>
                </div>
            </div>

            <div id="enviar">
                <button type="submit" id="botao" name="submit_agendamento">Enviar</button>
            </div>

        </div>

    </form>

    <div id="carregamento">
        <div class="roda"></div>
        <p>Enviando dados...</p>
    </div>
</main>

<script>
    const loadingOverlay = document.getElementById('carregamento');
    const formContainer = document.getElementById('content-container');

    function showLoading() {
        loadingOverlay.classList.add('visible');
    }

    if (formContainer) {
        formContainer.addEventListener('submit', function(event) {
            showLoading();
        });
    }
</script>
<footer>
    <p>© 2025 <span>VitaCare</span> — Todos os direitos reservados.</p>
</footer>

</body>
</html>