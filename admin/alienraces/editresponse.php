<?php
// admin/alienraces/editresponse.php
include_once('../../functions/functions.php');
$db = dbLink();

// Recebe os dados via POST
$id         = $_POST['id'] ?? null;
$race_name  = $_POST['race_name'] ?? '';
$homeworld  = $_POST['homeworld'] ?? '';
$traits     = $_POST['traits'] ?? '';

// Validação básica
if (empty($id) || empty($race_name) || empty($homeworld) || empty($traits)) {
    echo "Todos os campos são obrigatórios.";
    exit;
}

// Atualiza no banco
if (updateAlienRace($db, $id, $race_name, $homeworld, $traits)) {
    echo "Raça alienígena atualizada com sucesso!";
} else {
    echo "Erro ao atualizar raça alienígena.";
}
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<br>
<a href="index.php">Voltar para a lista de raças alienígenas</a>
