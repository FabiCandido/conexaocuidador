<?php
// Incluindo o arquivo de conexão
require 'bd.php';

// Recebendo os dados do formulário via método POST
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$servico = $_POST['servico'];
$obs = $_POST['obs'];

$datainc = date('Y-m-d');

// Verifica se o CPF já existe no banco de dados
$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE cpf = :cpf");
$stmt->bindParam(':cpf', $cpf);
$stmt->execute();
$cpfExistente = $stmt->fetchColumn();

if ($cpfExistente > 0) {
    // CPF já existe, redireciona de volta para a página de cadastro com uma mensagem de erro
    header("Location: login.php?erro=2");
    exit();
}

// Criando a consulta SQL com Prepared Statements para inserir os dados
$stmt = $conn->prepare("INSERT INTO users (nome, cpf, email, endereco, telefone, servico, obs, datainc) 
                                   VALUES (:nome, :cpf, :email, :endereco, :telefone, :servico, :obs, :datainc)");

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':endereco', $endereco);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':servico', $servico);
$stmt->bindParam(':obs', $obs);
$stmt->bindParam(':datainc', $datainc);

// Executando a consulta
$stmt->execute();

header("Location: index.php");
exit();

// Fechando a conexão (opcional, pois o script vai terminar logo em seguida)
$conn = null;
?>
