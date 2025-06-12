<?php
// admin/skills/viewdetails.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$skill = getSkillById($db, $id);
if (!$skill) {
    echo "Skill not found.";
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
    <title>Skill Details</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="skills-page">
<div class="site-wrapper">
    <header>
        <h1>Skill Details</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Skills List</a></li>
        </ul>
    </nav>

    <main>
        <h2><?php echo htmlspecialchars($skill['skill']); ?></h2>
        <p><strong>Character Name:</strong> <?php echo htmlspecialchars($skill['name']); ?></p>
        <p><strong>About the Skill:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($skill['about'])); ?></p>
    </main>

    <footer>
        <a href="index.php">Back to Skills List</a>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>
