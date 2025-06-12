<?php
// admin/skills/editskill.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$skill = getSkillById($db, $id);
if (!$skill) {
    echo "Skill not found.";
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
    <title>Edit Skill</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="skills-page">
<div class="site-wrapper">
    <header>
        <h1>Edit Skill: <?php echo htmlspecialchars($skill['skill']); ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
            <li><a href="index.php">Skills List</a></li>
        </ul>
    </nav>

    <main>
        <form action="editresponse.php" method="post">
            <input type="hidden" name="id" value="<?php echo $skill['id']; ?>">

            <p>
                <label for="name">Character Name:</label><br>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($skill['name']); ?>" required>
            </p>
            <p>
                <label for="skill">Skill:</label><br>
                <input type="text" name="skill" id="skill" value="<?php echo htmlspecialchars($skill['skill']); ?>" required>
            </p>
            <p>
                <label for="about">About the Skill:</label><br>
                <textarea name="about" id="about" rows="4" cols="50" required><?php echo htmlspecialchars($skill['about']); ?></textarea>
            </p>
            <p>
                <input type="submit" value="Update Skill">
            </p>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>