<?php
$servername = "162.241.61.25";
$username = "gdsob982_cc";
$password = "gdsob982_cc";
$dbname = "gdsob982_cc";

try {
    // Criando a conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurando o modo de erro do PDO para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit(); // Encerrar o script se a conexão falhar
}
?>
