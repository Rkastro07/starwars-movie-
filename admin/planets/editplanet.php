<?php
// admin/planets/editplanet.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$planet = getPlanetById($db, $id);
if (!$planet) {
    echo "Planet not found.";
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
    <title>Edit Planet</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">
    <header>
        <h1>Edit Planet: <?php echo $planet['planet_name']; ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Planets List</a></li>
        </ul>
    </nav>

    <main>
        <form action="editresponse.php" method="post">
            <input type="hidden" name="id" value="<?php echo $planet['id']; ?>">

            <p>
                <label for="planet_name">Planet Name:</label><br>
                <input type="text" name="planet_name" id="planet_name" 
                       value="<?php echo $planet['planet_name']; ?>" required>
            </p>
            <p>
                <label for="region">Region:</label><br>
                <input type="text" name="region" id="region"
                       value="<?php echo $planet['region']; ?>" required>
            </p>
            <p>
                <label for="description">Description:</label><br>
                <textarea name="description" id="description" rows="4" cols="50" required><?php
                    echo $planet['description'];
                ?></textarea>
            </p>
            <p>
                <input type="submit" value="Update Planet">
            </p>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>