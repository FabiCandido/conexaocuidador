<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php");
    exit();
}

// Incluindo o arquivo de conexão
require 'bd.php';

// Recebe o cpf do usuário logado
$cpf = $_SESSION['cpf'];

// Busca os dados do usuário no banco de dados
$stmt = $conn->prepare("SELECT * FROM users WHERE cpf = :cpf");
$stmt->bindParam(':cpf', $cpf);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o formulário foi submetido, atualiza os dados do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $servico = $_POST['servico'];
    $obs = $_POST['obs'];

    $updateStmt = $conn->prepare("UPDATE users SET email = :email, endereco = :endereco, telefone = :telefone, servico = :servico, obs = :obs WHERE cpf = :cpf");
    $updateStmt->bindParam(':email', $email);
    $updateStmt->bindParam(':endereco', $endereco);
    $updateStmt->bindParam(':telefone', $telefone);
    $updateStmt->bindParam(':servico', $servico);
    $updateStmt->bindParam(':obs', $obs);
    $updateStmt->bindParam(':cpf', $cpf);

    if ($updateStmt->execute()) {
        // Atualiza a sessão com o novo email se o email foi alterado
        header("Location: editar_perfil.php?ok=1");
        exit();
    } else {
        echo "Erro ao atualizar os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <style>
        /* Estilos similares à tela de cadastro e login */
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
            text-align: center;
            color: #1e3f5a;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #1e3f5a;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #1e3f5a;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #163448;
        }

        att{
            text-align: center;
            color: green;
            font-weight: bold;
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
</head>
<body>
    <div class="container">
        <?php if(isset($_GET['ok'])){
            echo "<att><center>Dados atualizados com sucesso!</center></att>";
            }?>
        <h2>Editar Perfil</h2>
        <form action="editar_perfil.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($user['endereco']) ?>" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" value="<?= htmlspecialchars($user['telefone']) ?>" required>
            </div>
            <div class="form-group">
                <label for="servico">Serviço</label>
                <input type="text" id="servico" name="servico" value="<?= htmlspecialchars($user['servico']) ?>" required>
            </div>
            <div class="form-group">
                <label for="obs">Observações</label>
                <textarea id="obs" name="obs"><?= htmlspecialchars($user['obs']) ?></textarea>
            </div>
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
    <!-- Botão de login fixo na barra inferior direita -->
    <div class="login-button-fixed" onclick="window.location.href='sair.php';">Sair</div>
</body>
</html>
