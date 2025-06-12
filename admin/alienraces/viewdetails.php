<?php
// admin/alienraces/viewdetails.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$race = getAlienRaceById($db, $id);
if (!$race) {
    echo "Alien race not found.";
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
    <title>Alien Race Details</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">
    <header>
        <h1>Alien Race Details</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Alien Races List</a></li>
        </ul>
    </nav>

    <main>
        <h2><?php echo htmlspecialchars($race['race_name']); ?></h2>
        <p><strong>Homeworld:</strong> <?php echo htmlspecialchars($race['homeworld']); ?></p>
        <p><strong>Traits:</strong> <?php echo nl2br(htmlspecialchars($race['traits'])); ?></p>
    </main>

    <footer>
        <a href="index.php">Back to Alien Races List</a>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>
