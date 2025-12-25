<?php
if(!isset($_SESSION)) {
    session_start();
}
$BASE_URL = "/Vitacare";

$mensagem_feedback = "";

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        $mensagem_feedback = "<p style='color: green; font-weight: bold; text-align: center;'>✅ Cadastro realizado com sucesso!</p>";
    } elseif ($_GET['status'] == 'error') {
        if ($_GET['code'] == '1062') {
            $mensagem_feedback = "<p style='color: red; font-weight: bold; text-align: center;'>❌ Erro: CPF ou E-mail já cadastrado.</p>";
        } else {
            $mensagem_feedback = "<p style='color: red; font-weight: bold; text-align: center;'>❌ Erro no cadastro. Tente novamente.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/cadastro.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare Cadastro</title>
</head>
<body>

<div id="gotas">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            background: url('../Img/fundo.jpg') center/cover no-repeat fixed;
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            display: block;
            pointer-events: none;
            z-index: 0;
        }
    </style>

    <canvas id="rain"></canvas>

    <script>
        const c = document.getElementById('rain');
        const ctx = c.getContext('2d');
        let w = window.innerWidth;
        let h = window.innerHeight;
        c.width = w;
        c.height = h;

        function criarGotas(qtd) {
            return Array.from({ length: qtd }, () => ({
                x: Math.random() * w,
                y: Math.random() * h,
                l: Math.random() * 20 + 10,
                s: Math.random() * 4 + 2
            }));
        }

        let drops = criarGotas(120);
        let mx = 0, my = 0;

        document.addEventListener('mousemove', e => {
            mx = e.clientX;
            my = e.clientY;
        });

        function draw() {
            ctx.clearRect(0, 0, w, h);
            drops.forEach(d => {
                const ox = (mx - w / 2) * 0.02;
                const oy = (my - h / 2) * 0.02;

                ctx.fillStyle = 'rgba(137, 216, 230)';

                ctx.fillRect(d.x + ox, d.y + oy, 2, d.l);
                d.y += d.s;

                if (d.y > h) {
                    d.y = -d.l;
                    d.x = Math.random() * w;
                }
            });
            requestAnimationFrame(draw);
        }

        draw();

        window.addEventListener('resize', () => {
            w = window.innerWidth;
            h = window.innerHeight;
            c.width = w;
            c.height = h;
            drops = criarGotas(120);
        });
    </script>
</div>

<section id="borda">

    <div id="logo">
        <img src="../Img/logo_h.png" class="logo">
    </div>

    <div class="logotipagem">
        <h1>VitaCare Cadastro</h1>
        <p><h3>Saude e bem-estar ao seu alcance</h3></p>
    </div>
    <?php echo $mensagem_feedback; ?>
    <form action="../php/processo_cadastro.php" method="post">
        <div id="input_usu-sen">
            <input name="nome" placeholder="Nome Completo" type="text" required>
            <input name="telefone" placeholder="Telefone" type="tel" required>
            <input name="cpf" placeholder="CPF" type="text" required>
            <input name="data_n" placeholder="Data de Nascimento" type="date" required>
            <input name="email" placeholder="Gmail" type="email" required>
            <input name="senha" placeholder="Senha" type="password" required>
            <select name="estado" id="esta" required>
                <option value="">Seu Estado de Nascimento</option>
                <option value="SP">São Paulo (SP)</option>
                <option value="AC">Acre (AC)</option>
                <option value="AL">Alagoas (AL)</option>
                <option value="AP">Amapá (AP)</option>
                <option value="AM">Amazonas (AM)</option>
                <option value="BA">Bahia (BA)</option>
                <option value="CE">Ceará (CE)</option>
                <option value="DF">Distrito Federal (DF)</option>
                <option value="ES">Espírito Santo (ES)</option>
                <option value="GO">Goiás (GO)</option>
                <option value="MA">Maranhão (MA)</option>
                <option value="MT">Mato Grosso (MT)</option>
                <option value="MS">Mato Grosso do Sul (MS)</option>
                <option value="MG">Minas Gerais (MG)</option>
                <option value="PA">Pará (PA)</option>
                <option value="PB">Paraíba (PB)</option>
                <option value="PR">Paraná (PR)</option>
                <option value="PE">Pernambuco (PE)</option>
                <option value="PI">Piauí (PI)</option>
                <option value="RJ">Rio de Janeiro (RJ)</option>
                <option value="RN">Rio Grande do Norte (RN)</option>
                <option value="RS">Rio Grande do Sul (RS)</option>
                <option value="RO">Rondônia (RO)</option>
                <option value="RR">Roraima (RR)</option>
                <option value="SC">Santa Catarina (SC)</option>
                <option value="SP">São Paulo (SP)</option>
                <option value="SE">Sergipe (SE)</option>
                <option value="TO">Tocantins (TO)</option>
            </select>

            <div class="escolha">
                <select name="tipo" id="tip">
                    <option value="">Seu Tipo Sanguíneo</option>
                    <option value="O+">O Positivo (O+)</option>
                    <option value="O-">O Negativo (O-)</option>
                    <option value="A+">A Positivo (A+)</option>
                    <option value="A-">A Negativo (A-)</option>
                    <option value="B+">B Positivo (B+)</option>
                    <option value="B-">B Negativo (B-)</option>
                    <option value="AB+">AB Positivo (AB+)</option>
                    <option value="AB-">AB Negativo (AB-)</option>
                </select>
            </div>

        </div>
        <button id="cad01" class="cadastro" type="submit">Cadastro</button>
    </form>
    
    <div class="login">
        <p>Ja tem conta?
            <a href="login.php">Login</a></p>
    </div>
</section>

<footer>
    <p>© 2025 <span>VitaCare</span> — Todos os direitos reservados.</p>
</footer>

</body>
</html>