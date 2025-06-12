<?php
// admin/planets/index.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get list of planets
$planets = listPlanets($db);
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
    <title>Admin - Planets</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">

    <header>
        <h1>Admin - Star Wars Planets</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="../../pages/planets.php">Planets (Public)</a></li>
        </ul>
    </nav>

    <main>
        <h2>Add New Planet</h2>
        <form action="addplanet.php" method="post">
            <p>
                <label for="planet_name">Planet Name:</label><br>
                <input type="text" name="planet_name" id="planet_name" required>
            </p>
            <p>
                <label for="region">Region:</label><br>
                <input type="text" name="region" id="region" required>
            </p>
            <p>
                <label for="description">Description:</label><br>
                <textarea name="description" id="description" rows="4" cols="50" required></textarea>
            </p>
            <p>
                <input type="submit" value="Add Planet">
            </p>
        </form>

        <hr>

        <h2>Planets List</h2>
        <?php if (!empty($planets)): ?>
            <ul>
                <?php foreach($planets as $planet): ?>
                    <li>
                        <strong><?php echo $planet['planet_name']; ?></strong> 
                        (Region: <?php echo $planet['region']; ?>)
                        <br>
                        <a href="viewdetails.php?id=<?php echo $planet['id']; ?>">[View Details]</a> 
                        <a href="editplanet.php?id=<?php echo $planet['id']; ?>">[Edit]</a> 
                        <a href="del.php?id=<?php echo $planet['id']; ?>">[Remove]</a>
                    </li>
                    <br>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No planets registered.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>
