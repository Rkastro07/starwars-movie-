<?php
// admin/planets/viewdetails.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID não fornecido.";
    exit;
}

$planet = getPlanetById($db, $id);
if (!$planet) {
    echo "Planeta não encontrado.";
    exit;
}
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Planet Details</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">
    <header>
        <h1>Planet Details</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Lista de Planetas</a></li>
        </ul>
    </nav>

    <main>
        <h2><?php echo $planet['planet_name']; ?></h2>
        <p><strong>Region:</strong> <?php echo $planet['region']; ?></p>
        <p><strong>Description:</strong> <?php echo $planet['description']; ?></p>
    </main>

    <footer>
        <a href="index.php">Back</a>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>
