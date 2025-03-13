<?php
session_start();

// Destroi todas as variáveis de sessão
session_unset();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login ou outra página
header("Location: index.php");
exit();
?>