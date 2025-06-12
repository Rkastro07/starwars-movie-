<?php
// admin/aspects/viewdetails.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$aspect = getAspectById($db, $id);
if (!$aspect) {
    echo "Aspect not found.";
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
    <title>Aspect Details</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="aspects-page">
<div class="site-wrapper">
    <header>
        <h1>Aspect Details</h1>
    </header>
    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Lista de Aspectos</a></li>
        </ul>
    </nav>

    <main>
        <h2><?php echo htmlspecialchars($aspect['aspect']); ?></h2>
        <p><strong>Definition:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($aspect['definition'])); ?></p>
    </main>
</div>
</body>
</html>
