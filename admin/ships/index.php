<?php
// admin/ships/index.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get the list of ships
$ships = listShips($db);
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
    <title>Admin - Ships</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body>
<div class="site-wrapper">
    <header>
        <h1>Admin - Star Wars Ships</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="../../pages/ships.php">Ships (Public)</a></li>
        </ul>
    </nav>

    <main>
        <h2>Add New Ship</h2>
        <form action="addship.php" method="post">
            <p>
                <label for="ship_name">Ship Name:</label><br>
                <input type="text" name="ship_name" id="ship_name" required>
            </p>
            <p>
                <label for="model">Model:</label><br>
                <input type="text" name="model" id="model" required>
            </p>
            <p>
                <label for="description">Description:</label><br>
                <textarea name="description" id="description" rows="4" cols="50" required></textarea>
            </p>
            <p>
                <input type="submit" value="Add Ship">
            </p>
        </form>

        <hr>

        <h2>Ships List</h2>
        <?php if (!empty($ships)): ?>
            <ul>
                <?php foreach ($ships as $ship): ?>
                    <li>
                        <strong><?php echo $ship['ship_name']; ?></strong>
                        (Model: <?php echo $ship['model']; ?>)
                        <br>
                        <a href="viewdetails.php?id=<?php echo $ship['id']; ?>">[View Details]</a>
                        <a href="editship.php?id=<?php echo $ship['id']; ?>">[Edit]</a>
                        <a href="del.php?id=<?php echo $ship['id']; ?>">[Remove]</a>
                    </li>
                    <br>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No ships registered.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>