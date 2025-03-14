<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão Cuidador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            color: #1e3f5a;
            height: 100vh;
            position: relative;
            background-image: url('old.jpg'); /* Substitua pelo caminho da sua imagem */
            background-size: cover; /* Cobre toda a tela */
            background-position: center; /* Centraliza a imagem */
            background-repeat: no-repeat; /* Evita repetição da imagem */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Fundo branco semitransparente */
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            overflow-x: auto;
        }

        h1 {
            text-align: center;
            color: #1e3f5a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1e3f5a;
            color: white;
        }

        td a {
            color: #1e3f5a;
            text-decoration: none;
            display: block;
            width: 100%;
            height: 100%;
        }

        td a:hover {
            background-color: #f0f4f8;
        }

        .login-button-fixed {
            position: fixed;
            bottom: 20px;
            right: 20px;
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

        @media (max-width: 480px) {
            th, td {
                padding: 8px;
                font-size: 12px;
            }

            .login-button-fixed {
                font-size: 14px;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Conexão Cuidador</h1>
        <table>
            <tr>
                <th>Cuidadores</th>
            </tr>
            <?php
         
            require 'bd.php';

            try {
                $stmt = $conn->prepare("SELECT id, nome, cpf, email, endereco, telefone, servico, datainc FROM users order by nome");
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td><a href='detalhes_cadastro.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['nome']) . "</a></td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='7'>Erro ao buscar cadastros: " . $e->getMessage() . "</td></tr>";
            }

            $conn = null;
            ?>
        </table>
    </div>

    <!-- Botão de login fixo na barra inferior direita -->
    <button class="login-button-fixed" onclick="window.location.href='login.php';">Login</button>
</body>
</html>
