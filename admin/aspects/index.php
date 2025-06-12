<?php
// admin/aspects/index.php
include_once('../../functions/functions.php');
$db = dbLink();

// List aspects
$aspects = listAspects($db);
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
    <title>Admin - Aspects</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="aspects-page">
<div class="site-wrapper">

    <header>
        <h1>Admin - Star Wars Aspects</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="../../pages/theforce.php">The Force (Public)</a></li>
        </ul>
    </nav>

    <main>
        <h2>Add New Aspect</h2>
        <form action="addaspect.php" method="post">
            <p>
                <label for="aspect">Aspect:</label><br>
                <input type="text" name="aspect" id="aspect" required>
            </p>
            <p>
                <label for="definition">Definition:</label><br>
                <textarea name="definition" id="definition" rows="4" cols="50" required></textarea>
            </p>
            <p>
                <input type="submit" value="Add Aspect">
            </p>
        </form>

        <hr>

        <h2>Aspects List</h2>
        <?php if (!empty($aspects)): ?>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Aspect</th>
                        <th>Definition</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aspects as $aspect): ?>
                        <tr>
                            <td><?php echo $aspect['id']; ?></td>
                            <td><?php echo htmlspecialchars($aspect['aspect']); ?></td>
                            <td><?php echo htmlspecialchars(substr($aspect['definition'], 0, 100)) . "..."; ?></td>
                            <td>
                                <a href="viewdetails.php?id=<?php echo $aspect['id']; ?>">View</a>| 
                                <a href="editaspect.php?id=<?php echo $aspect['id']; ?>">Edit</a> |
                                <a href="del.php?id=<?php echo $aspect['id']; ?>" onclick="return confirm('Are you sure you want to remove this aspect?');">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No aspects registered.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>