<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Conexão Cuidador</title>
    <style>
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #1e3f5a;
            background-image: url('old.jpg'); /* Substitua pelo caminho da sua imagem */
            background-size: cover; /* Cobre toda a tela */
            background-position: center; /* Centraliza a imagem */
            background-repeat: no-repeat; /* Evita repetição da imagem */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Fundo branco semitransparente */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #1e3f5a;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #1e3f5a;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .btn-entrar, .btn-cadastrar {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-entrar {
            background-color: #1e3f5a;
        }

        .btn-entrar:hover {
            background-color: #163448;
        }

        .btn-cadastrar {
            background-color: #4CAF50;
        }

        .btn-cadastrar:hover {
            background-color: #45a049;
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            .btn-entrar, .btn-cadastrar {
                font-size: 14px;
                padding: 8px;
            }
        }

        att{
            text-align: center;
            color: red;
        }

        .login-button-fixed {
            position: fixed;
            bottom: 20px !important;
            right: 20px !important;
            background-color: #1e3f5a;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            z-index: 1000;
        }

        .login-button-fixed:hover {
            background-color: #163448;
        }

        .login-button-fixed {
                font-size: 14px !important;
                padding: 8px 15px !important;
            }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <h2>Login<br/>Conexão Cuidador</h2>
        <?php if(isset($_GET['erro'])){
            if($_GET['erro'] == 1){
            echo "<att><center>Email ou senha incorreto!</center></att>";
            }
            elseif($_GET['erro'] == 2){
            echo "<att><center>CPF já cadastro, efetue o login!</center></att>";
            }
            }?>

        <form action="processa_login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF (Senha)</label>
                <input type="password" id="cpf" name="cpf" required>
            </div>
            <button type="submit" class="btn-entrar">Entrar</button>
        </form>
        <button onclick="window.location.href='cadastro.php';" class="btn-cadastrar">Cadastrar-se</button>
    </div>
    <div class="login-button-fixed" onclick="window.location.href='index.php';">Cuidadores</div>
</body>
</html>

