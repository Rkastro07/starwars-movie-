<?php
// admin/characters/editcharacter.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$character = getCharacterById($db, $id);
if (!$character) {
    echo "Character not found.";
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
    <title>Edit Character</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">
    <header>
        <h1>Edit Character: <?php echo htmlspecialchars($character['name']); ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Characters List</a></li>
        </ul>
    </nav>

    <main>
        <form action="editresponse.php" method="post">
            <input type="hidden" name="id" value="<?php echo $character['id']; ?>">

            <p>
                <label for="name">Character Name:</label><br>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($character['name']); ?>" required>
            </p>
            <p>
                <label for="affiliation">Affiliation:</label><br>
                <input type="text" name="affiliation" id="affiliation" value="<?php echo htmlspecialchars($character['affiliation']); ?>" required>
            </p>
            <p>
                <label for="details">Details:</label><br>
                <textarea name="details" id="details" rows="4" cols="50" required><?php echo htmlspecialchars($character['details']); ?></textarea>
            </p>
            <p>
                <input type="submit" value="Update Character">
            </p>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>