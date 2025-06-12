<?php
// admin/ships/editship.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$ship = getShipById($db, $id);
if (!$ship) {
    echo "Ship not found.";
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
    <title>Edit Ship</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body>
<div class="site-wrapper">
    <header>
        <h1>Edit Ship: <?php echo $ship['ship_name']; ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Ships List</a></li>
        </ul>
    </nav>

    <main>
        <form action="editresponse.php" method="post">
            <input type="hidden" name="id" value="<?php echo $ship['id']; ?>">

            <p>
                <label for="ship_name">Ship Name:</label><br>
                <input type="text" name="ship_name" id="ship_name" value="<?php echo $ship['ship_name']; ?>" required>
            </p>
            <p>
                <label for="model">Model:</label><br>
                <input type="text" name="model" id="model" value="<?php echo $ship['model']; ?>" required>
            </p>
            <p>
                <label for="description">Description:</label><br>
                <textarea name="description" id="description" rows="4" cols="50" required><?php
                    echo $ship['description'];
                ?></textarea>
            </p>
            <p><input type="submit" value="Update Ship"></p>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>