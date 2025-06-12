<?php
// pages/movies.php
include_once('../functions/functions.php');
$db = dbLink();

// Carrega todos os filmes do banco
$movies = listMovies($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars Movies</title>
    <link rel="stylesheet" href="../style/css.css">
</head>
<body class="movies-page">
    <div class="site-wrapper">
        <header>
            <h1>Star Wars Universe</h1>
        </header>

        <nav>
        <ul>
      <li><a href="../index.php">Home</a></li>
        <li><a href="movies.php">Movies</a></li>
        <li><a href="planets.php">Planets</a></li>
        <li><a href="ships.php">Ships</a></li>
        <li><a href="alienraces.php">Alien races</a></li>
        <li><a href="characters.php">Characters</a></li>
        <li><a href="summary.php">Summary</a></li>
        <li><a href="theforce.php">The Force</a></li>
         <!-- Link para a parte ADM -->
        <li><a href="../admin/dashboard.php">Admin Dashboard</a></li>
        
      </ul>
        </nav>

        <main>
            <div class="img-box">
                <img src="../img/2.jpg" alt="Millennium Falcon">
            </div>
            <h2>Movies</h2>
            <p>
                Below is the list of Star Wars movies available in our database.
            </p>

            <?php if (!empty($movies)): ?>
                <ul>
                    <?php foreach($movies as $film): ?>
                    <li>
                        <strong><?php echo $film['title']; ?></strong>
                        (<?php echo $film['release_year']; ?>)<br>
                        Directed by: <?php echo $film['director']; ?><br>
                        <em><?php echo htmlspecialchars($film['synopsis']); ?></em>
                    </li>
                    <br>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No movies found.</p>
            <?php endif; ?>
        </main>

        <footer>
            <p>&copy; 2025 Star Wars Universe</p>
        </footer>
    </div>
</body>
</html>
