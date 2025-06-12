<?php
// admin/movies/viewdetails.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID não fornecido.";
    exit;
}
$movie = getMovieById($db, $id);
if (!$movie) {
    echo "Filme não encontrado.";
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
    <title>Detalhes do Filme (Admin)</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">
    <header>
        <h1>Detalhes do Filme</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../../pages/movies.php">Movies (Público)</a></li>
            <li><a href="index.php">Admin - Lista de Filmes</a></li>
        </ul>
    </nav>

    <main>
        <h2><?php echo $movie['title']; ?> (<?php echo $movie['release_year']; ?>)</h2>
        <p><strong>Director:</strong> <?php echo $movie['director']; ?></p>
        <p><strong>Sinopse:</strong> <?php echo $movie['synopsis']; ?></p>
    </main>

    <footer>
        <a href="index.php">Back</a>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>
