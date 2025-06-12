<?php
// admin/skills/index.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get list of skills
$skills = listSkills($db);
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
    <title>Admin - Skills</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="skills-page">
<div class="site-wrapper">

    <header>
        <h1>Admin - Star Wars Skills</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="../../pages/theforce.php">The Force (Public)</a></li>
        </ul>
    </nav>

    <main>
        <h2>Add New Skill</h2>
        <form action="addskill.php" method="post">
            <p>
                <label for="name">Character Name:</label><br>
                <input type="text" name="name" id="name" required>
            </p>
            <p>
                <label for="skill">Skill:</label><br>
                <input type="text" name="skill" id="skill" required>
            </p>
            <p>
                <label for="about">About the Skill:</label><br>
                <textarea name="about" id="about" rows="4" cols="50" required></textarea>
            </p>
            <p>
                <input type="submit" value="Add Skill">
            </p>
        </form>

        <hr>

        <h2>Skills List</h2>
        <?php if (!empty($skills)): ?>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Character Name</th>
                        <th>Skill</th>
                        <th>About</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($skills as $skill): ?>
                        <tr>
                            <td><?php echo $skill['id']; ?></td>
                            <td><?php echo htmlspecialchars($skill['name']); ?></td>
                            <td><?php echo htmlspecialchars($skill['skill']); ?></td>
                            <td><?php echo htmlspecialchars(substr($skill['about'], 0, 100)) . "..."; ?></td>
                            <td>
                                <a href="viewdetails.php?id=<?php echo $skill['id']; ?>">Edit</a> |
                                <a href="del.php?id=<?php echo $skill['id']; ?>" onclick="return confirm('Are you sure you want to remove this skill?');">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No skills registered.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>