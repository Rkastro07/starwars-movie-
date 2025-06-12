<?php
// admin/summary/index.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get summaries list
$summaries = listSummaries($db);
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
    <title>Admin - Summary</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="summary-page">
<div class="site-wrapper">

    <header>
        <h1>Admin - Star Wars Summary</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="../../pages/summary.php">Summary (Public)</a></li>
        </ul>
    </nav>

    <main>
        <h2>Add New Summary</h2>
        <form action="addsummary.php" method="post">
            <p>
                <label for="era_title">Era Title:</label><br>
                <input type="text" name="era_title" id="era_title" required>
            </p>
            <p>
                <label for="summary_text">Summary Text:</label><br>
                <textarea name="summary_text" id="summary_text" rows="6" cols="60" required></textarea>
            </p>
            <p>
                <input type="submit" value="Add Summary">
            </p>
        </form>

        <hr>

        <h2>Summaries List</h2>
        <?php if (!empty($summaries)): ?>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Era Title</th>
                        <th>Summary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($summaries as $summary): ?>
                        <tr>
                            <td><?php echo $summary['id']; ?></td>
                            <td><?php echo htmlspecialchars($summary['era_title']); ?></td>
                            <td><?php echo htmlspecialchars(substr($summary['summary_text'], 0, 100)) . "..."; ?></td>
                            <td>
                                <a href="viewdetails.php?id=<?php echo $summary['id']; ?>">View</a> 
                                <a href="editsummary.php?id=<?php echo $summary['id']; ?>">[Edit]</a>
                                <a href="del.php?id=<?php echo $summary['id']; ?>" onclick="return confirm('Are you sure you want to remove this summary?');">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No summaries registered.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>