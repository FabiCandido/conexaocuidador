<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Conexão Cuidador</title>
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

        h1 {
            text-align: center;
            color: #1e3f5a;
        }

        p {
            margin-bottom: 10px;
        }

        .back-button-fixed {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #1e3f5a;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            z-index: 1000;
        }

        .back-button-fixed:hover {
            background-color: #163448;
        }

        @media (max-width: 480px) {
            .back-button-fixed {
                font-size: 14px;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalhes do Cadastro</h1>
        <?php
        require 'bd.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            try {
                $stmt = $conn->prepare("SELECT nome, cpf, email, endereco, telefone, servico, obs, datainc FROM users WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    echo "<p><strong>Nome:</strong> " . htmlspecialchars($row['nome']) . "</p>";
                    echo "<p><strong>CPF:</strong> " . htmlspecialchars($row['cpf']) . "</p>";
                    echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                    echo "<p><strong>Endereço:</strong> " . htmlspecialchars($row['endereco']) . "</p>";
                    echo "<p><strong>Telefone:</strong> <a href='https://api.whatsapp.com/send?phone=55" . $row['telefone'] . "&text=Olá%20Cuidador " .$row['nome'] . ",%20você%20pode%20me%20ajudar?'>" . htmlspecialchars($row['telefone']). "<i class='fab fa-whatsapp' style='color: #25D366;'></i></a></p>";
                    echo "<p><strong>Serviço:</strong> " . htmlspecialchars($row['servico']) . "</p>";
                    echo "<p><strong>Observações:</strong> " . htmlspecialchars($row['obs']) . "</p>";
                    echo "<p><strong>Data de Cadastro:</strong> " . htmlspecialchars(date('d/m/Y', strtotime($row['datainc']))) . "</p>";
                } else {
                    echo "<p>Aguardando cadastros...</p>";
                }
            } catch (PDOException $e) {
                echo "<p>Erro ao buscar detalhes: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p>ID não fornecido.</p>";
        }

        $conn = null;
        ?>
    </div>

    <!-- Botão de voltar fixo na barra inferior esquerda -->
    <button class="back-button-fixed" onclick="window.history.back();">Voltar</button>
</body>
</html>
