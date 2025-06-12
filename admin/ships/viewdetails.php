<?php
// admin/ships/viewdetails.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$ship = getShipById($db, $id);
if (!$ship) {
    echo "Ship not found.";
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
    <title>Ship Details</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body>
<div class="site-wrapper">
    <header>
        <h1>Ship Details</h1>
    </header>

    <main>
        <h2><?php echo $ship['ship_name']; ?></h2>
        <p><strong>Model:</strong> <?php echo $ship['model']; ?></p>
        <p><strong>Description:</strong> <?php echo $ship['description']; ?></p>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>