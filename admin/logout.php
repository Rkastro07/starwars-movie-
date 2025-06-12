<?php
// admin/logout.php
session_start();

// Destrói todas as variáveis de sessão
$_SESSION = array();

// Finaliza a sessão
session_destroy();

// Redireciona para o dashboard (página de login)
header("Location: dashboard.php");
exit;
?>
