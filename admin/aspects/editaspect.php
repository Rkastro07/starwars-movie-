<?php
// admin/aspects/editaspect.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$aspect = getAspectById($db, $id);
if (!$aspect) {
    echo "Aspect not found.";
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
    <title>Edit Aspect</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="aspects-page">
<div class="site-wrapper">
    <header>
        <h1>Edit Aspect: <?php echo htmlspecialchars($aspect['aspect']); ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Aspects List</a></li>
        </ul>
    </nav>

    <main>
        <form action="editresponse.php" method="post">
            <input type="hidden" name="id" value="<?php echo $aspect['id']; ?>">

            <p>
                <label for="aspect">Aspect:</label><br>
                <input type="text" name="aspect" id="aspect" value="<?php echo htmlspecialchars($aspect['aspect']); ?>" required>
            </p>
            <p>
                <label for="definition">Definition:</label><br>
                <textarea name="definition" id="definition" rows="4" cols="50" required><?php echo htmlspecialchars($aspect['definition']); ?></textarea>
            </p>
            <p>
                <input type="submit" value="Update Aspect">
            </p>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>