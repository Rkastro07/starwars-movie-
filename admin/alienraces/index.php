<?php
// admin/alienraces/index.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get list of alien races
$alienraces = listAlienRaces($db);
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
    <title>Admin - Alien Races</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">

    <header>
        <h1>Admin - Star Wars Alien Races</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="../../pages/alienraces.php">Alien Races (Public)</a></li>
        </ul>
    </nav>

    <main>
        <h2>Add New Alien Race</h2>
        <form action="addalienrace.php" method="post">
            <p>
                <label for="race_name">Race Name:</label><br>
                <input type="text" name="race_name" id="race_name" required>
            </p>
            <p>
                <label for="homeworld">Homeworld:</label><br>
                <input type="text" name="homeworld" id="homeworld" required>
            </p>
            <p>
                <label for="traits">Traits:</label><br>
                <textarea name="traits" id="traits" rows="4" cols="50" required></textarea>
            </p>
            <p>
                <input type="submit" value="Add Race">
            </p>
        </form>

        <hr>

        <h2>List of Alien Races</h2>
        <?php if (!empty($alienraces)): ?>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Race Name</th>
                        <th>Homeworld</th>
                        <th>Traits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alienraces as $race): ?>
                        <tr>
                            <td><?php echo $race['id']; ?></td>
                            <td><?php echo htmlspecialchars($race['race_name']); ?></td>
                            <td><?php echo htmlspecialchars($race['homeworld']); ?></td>
                            <td><?php echo htmlspecialchars($race['traits']); ?></td>
                            <td>
                                <a href="viewdetails.php?id=<?php echo $race['id']; ?>">[View Details]</a> 
                                <a href="editalienrace.php?id=<?php echo $race['id']; ?>">[Edit]</a>
                                <a href="del.php?id=<?php echo $race['id']; ?>" onclick="return confirm('Are you sure you want to remove this race?');">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No alien races registered.</p>
        <?php endif; ?>
    </main>
</div>
</body>
</html>