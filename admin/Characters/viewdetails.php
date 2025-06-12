<?php
// admin/characters/viewdetails.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$character = getCharacterById($db, $id);
if (!$character) {
    echo "Character not found.";
    exit;
}
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Character Details</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">
    <header>
        <h1>Character Details</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Characters List</a></li>
        </ul>
    </nav>

    <main>
        <h2><?php echo htmlspecialchars($character['name']); ?></h2>
        <p><strong>Affiliation:</strong> <?php echo htmlspecialchars($character['affiliation']); ?></p>
        <p><strong>Details:</strong> <?php echo nl2br(htmlspecialchars($character['details'])); ?></p>
    </main>

    <footer>
        <a href="index.php">Back to Characters List</a>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>
