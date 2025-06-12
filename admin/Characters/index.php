<?php
// admin/characters/index.php
include_once('../../functions/functions.php');
$db = dbLink();

// List characters
$characters = listCharacters($db);
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
    <title>Admin - Characters</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">

    <header>
        <h1>Admin - Star Wars Characters</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="../../pages/characters.php">Characters (Public)</a></li>
        </ul>
    </nav>

    <main>
        <h2>Add New Character</h2>
        <form action="addcharacter.php" method="post">
            <p>
                <label for="name">Character Name:</label><br>
                <input type="text" name="name" id="name" required>
            </p>
            <p>
                <label for="affiliation">Affiliation:</label><br>
                <input type="text" name="affiliation" id="affiliation" required>
            </p>
            <p>
                <label for="details">Details:</label><br>
                <textarea name="details" id="details" rows="4" cols="50" required></textarea>
            </p>
            <p>
                <input type="submit" value="Add Character">
            </p>
        </form>

        <hr>

        <h2>Characters List</h2>
        <?php if (!empty($characters)): ?>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Affiliation</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($characters as $char): ?>
                        <tr>
                            <td><?php echo $char['id']; ?></td>
                            <td><?php echo htmlspecialchars($char['name']); ?></td>
                            <td><?php echo htmlspecialchars($char['affiliation']); ?></td>
                            <td><?php echo htmlspecialchars($char['details']); ?></td>
                            <td>
                                <a href="viewdetails.php?id=<?php echo $char['id']; ?>">[View Details]</a> 
                                <a href="editcharacter.php?id=<?php echo $char['id']; ?>">[Edit]</a>
                                <a href="del.php?id=<?php echo $char['id']; ?>" onclick="return confirm('Are you sure you want to remove this character?');">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No characters registered.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>