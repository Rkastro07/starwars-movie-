<?php
// admin/movies/editmovie.php
include_once('../../functions/functions.php');
$db = dbLink();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID not provided.";
    exit;
}

$movie = getMovieById($db, $id);
if (!$movie) {
    echo "Movie not found.";
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
    <title>Edit Movie</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">

    <header>
        <h1>Editing: <?php echo $movie['title']; ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../../pages/movies.php">Movies (Public)</a></li>
            <li><a href="index.php">Admin - Movies List</a></li>
        </ul>
    </nav>

    <main>
        <form action="editresponse.php" method="post">
            <!-- Hidden field with ID -->
            <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">

            <p>
                <label for="title">Title:</label><br>
                <input type="text" name="title" id="title" value="<?php echo $movie['title']; ?>" required>
            </p>
            <p>
                <label for="release_year">Release Year:</label><br>
                <input type="number" name="release_year" id="release_year" 
                       value="<?php echo $movie['release_year']; ?>" required>
            </p>
            <p>
                <label for="director">Director:</label><br>
                <input type="text" name="director" id="director" value="<?php echo $movie['director']; ?>" required>
            </p>
            <p>
                <label for="synopsis">Synopsis:</label><br>
                <textarea name="synopsis" id="synopsis" rows="4" cols="50" required><?php echo $movie['synopsis']; ?></textarea>
            </p>
            <p><input type="submit" value="Update"></p>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>