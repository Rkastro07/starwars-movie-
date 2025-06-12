<?php
include_once('../../functions/functions.php');
$db = dbLink();
$movies = listMovies($db);
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
    <title>Admin - Star Wars Movies</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
<div class="site-wrapper">

    <header>
        <h1>Admin - Star Wars Movies</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../../index.php">Home (Site)</a></li>
            <li><a href="../../pages/movies.php">Movies (Public)</a></li>
            <li><a href="index.php">Admin - Movies List</a></li>
        </ul>
    </nav>

    <main>
        <h2>Add New Movie</h2>
        <!-- Note: The form now uses multipart/form-data for file uploads -->
        <form action="addmovie.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="title">Movie Title:</label><br>
                <input type="text" name="title" id="title" required>
            </p>
            <p>
                <label for="release_year">Release Year:</label><br>
                <input type="number" name="release_year" id="release_year" required>
            </p>
            <p>
                <label for="director">Director:</label><br>
                <input type="text" name="director" id="director" required>
            </p>
            <p>
                <label for="synopsis">Synopsis:</label><br>
                <textarea name="synopsis" id="synopsis" rows="4" cols="50" required></textarea>
            </p>
            <!-- New File Input for Attachment -->
            <p>
                <label for="attachment">Attachment (e.g., Poster):</label><br>
                <input type="file" name="attachment" id="attachment" accept=".jpg,.jpeg,.png,.pdf">
            </p>
            <p>
                <input type="submit" value="Add Movie">
            </p>
        </form>

        <hr>

        <h2>Movies List</h2>
        <?php if (!empty($movies)): ?>
            <ul>
                <?php foreach($movies as $film): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($film['title']); ?></strong>
                        (<?php echo htmlspecialchars($film['release_year']); ?>) -
                        <?php echo htmlspecialchars($film['director']); ?>
                        <br>
                        <a href="viewdetails.php?id=<?php echo $film['id']; ?>">[View Details]</a>
                        <a href="editmovie.php?id=<?php echo $film['id']; ?>">[Edit]</a>
                        <a href="del.php?id=<?php echo $film['id']; ?>">[Remove]</a>
                    </li>
                    <br>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No movies registered.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe - Admin</p>
    </footer>
</div>
</body>
</html>
