<?php
// Incluindo o arquivo de conexão com o banco de dados
require 'bd.php';

// Recebendo os dados do formulário via método POST
$email = $_POST['email'];
$cpf = $_POST['cpf'];

try {
    // Criando a consulta SQL para verificar o usuário
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND cpf = :cpf");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cpf', $cpf);

    // Executando a consulta
    $stmt->execute();

    // Verificando se encontrou algum usuário
    if ($stmt->rowCount() > 0) {
        // Usuário encontrado, iniciar a sessão e redirecionar para a página de bem-vindo
        session_start();
        $_SESSION['cpf'] = $cpf;
        // Atualiza o data de login no BD.
        $datalogin = date('Y-m-d');
        $updateStmt = $conn->prepare("UPDATE users SET datalogin = :datalogin WHERE cpf = :cpf");
        $updateStmt->bindParam(':datalogin', $datalogin);
        $updateStmt->bindParam(':cpf', $cpf);
        $updateStmt->execute();
        // Redirecionar para a página desejada, por exemplo: bem_vindo.php
        header("Location: editar_perfil.php");
        exit();
    } else {
        // Usuário não encontrado, exibir mensagem de erro
        header("Location: login.php?erro=1");
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Fechando a conexão
$conn = null;
?>
