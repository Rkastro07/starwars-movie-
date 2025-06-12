<?php
// admin/summary/viewdetails.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$summary = getSummaryById($db, $id);
if (!$summary) {
    echo "Summary not found.";
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
    <title>Summary Details</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="summary-page">
<div class="site-wrapper">
    <header>
        <h1>Summary Details</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Summaries List</a></li>
        </ul>
    </nav>

    <main>
        <h2><?php echo htmlspecialchars($summary['era_title']); ?></h2>
        <p><strong>Summary:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($summary['summary_text'])); ?></p>
    </main>

    <footer>
        <a href="index.php">Back to Summaries List</a>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>
