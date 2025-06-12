<?php
// admin/alienraces/editalienrace.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$race = getAlienRaceById($db, $id);
if (!$race) {
    echo "Alien race not found.";
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
    <title>Edit Alien Race</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">
    <header>
        <h1>Edit Alien Race: <?php echo htmlspecialchars($race['race_name']); ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Alien Races List</a></li>
        </ul>
    </nav>

    <main>
        <form action="editresponse.php" method="post">
            <input type="hidden" name="id" value="<?php echo $race['id']; ?>">

            <p>
                <label for="race_name">Race Name:</label><br>
                <input type="text" name="race_name" id="race_name" value="<?php echo htmlspecialchars($race['race_name']); ?>" required>
            </p>
            <p>
                <label for="homeworld">Homeworld:</label><br>
                <input type="text" name="homeworld" id="homeworld" value="<?php echo htmlspecialchars($race['homeworld']); ?>" required>
            </p>
            <p>
                <label for="traits">Traits:</label><br>
                <textarea name="traits" id="traits" rows="4" cols="50" required><?php echo htmlspecialchars($race['traits']); ?></textarea>
            </p>
            <p>
                <input type="submit" value="Update Race">
            </p>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>