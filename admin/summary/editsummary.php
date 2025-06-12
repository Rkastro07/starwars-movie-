<?php
// admin/summary/editsummary.php
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
    <title>Edit Summary</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="summary-page">
<div class="site-wrapper">
    <header>
        <h1>Edit Summary: <?php echo htmlspecialchars($summary['era_title']); ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Summaries List</a></li>
        </ul>
    </nav>

    <main>
        <form action="editresponse.php" method="post">
            <input type="hidden" name="id" value="<?php echo $summary['id']; ?>">

            <p>
                <label for="era_title">Era Title:</label><br>
                <input type="text" name="era_title" id="era_title" value="<?php echo htmlspecialchars($summary['era_title']); ?>" required>
            </p>
            <p>
                <label for="summary_text">Summary Text:</label><br>
                <textarea name="summary_text" id="summary_text" rows="6" cols="60" required><?php echo htmlspecialchars($summary['summary_text']); ?></textarea>
            </p>
            <p>
                <input type="submit" value="Update Summary">
            </p>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>