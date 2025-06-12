<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars Universe - Home</title>
    <link rel="stylesheet" href="style/css.css">
</head>
<body class="home-page">
    <div class="site-wrapper">
        <header>
            <h1>Star Wars Universe</h1>
            <p>The ultimate Star Wars resource - Explore the Galaxy!</p>
        </header>

        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="pages/movies.php">Movies</a></li>
                <li><a href="pages/planets.php">Planets</a></li>
                <li><a href="pages/ships.php">Ships</a></li>
                <li><a href="pages/alienraces.php">Alien races</a></li>
                <li><a href="pages/characters.php">Characters</a></li>
                <li><a href="pages/summary.php">Summary</a></li>
                <li><a href="pages/theforce.php">The Force</a></li>
                <!-- Link para a parte ADM -->
                <li><a href="admin/dashboard.php">Admin Dashboard</a></li>
            </ul>
        </nav>

        <main>
            <div class="img-box">
                <img src="img/4.jpg" alt="Millennium Falcon">
            </div>
            <h2>Welcome to the Star Wars Universe</h2>
            <p>
                A long time ago in a galaxy far, far away... 
                This site contains information about Star Wars movies, iconic characters,
                legendary ships, and more. You can also learn about Jedi, Sith,
                alien races, and the mysterious Force that binds the galaxy together.
            </p>
            <p>
                Feel free to explore the various pages to discover more about
                the expansive Star Wars Universe!
            </p>
            <!-- Exemplo de CTA -->
            <a href="pages/movies.php" class="cta">Explore Movies</a>
        </main>

        <footer>
            <p>&copy; 2025 Star Wars Universe</p>
        </footer>
    </div>
</body>
</html>
