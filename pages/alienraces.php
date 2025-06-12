<?php
// pages/alienraces.php
include_once('../functions/functions.php');
$db = dbLink();

// Lista das raças alienígenas para exibição
$alienraces = listAlienRaces($db);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Alien Races</title>
  <link rel="stylesheet" href="../style/css.css">
</head>
<body>
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
            <img src="../img/alien.jpg" alt="Alien Races">
        </div>
        <h2>Alien Races</h2>
        <p>
            The Star Wars galaxy is home to countless alien species, each with 
            unique characteristics:
        </p>

        <?php if (!empty($alienraces)): ?>
            <ul>
                <?php foreach ($alienraces as $race): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($race['race_name']); ?></strong>
                        (Mundo Natal: <?php echo htmlspecialchars($race['homeworld']); ?>)
                        <br>
                        <?php
                            // Exibir parte da descrição, se preferir
                            echo htmlspecialchars($race['traits']);
                        ?>
                    </li>
                    <br>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhuma raça alienígena encontrada no banco de dados.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Star Wars Universe</p>
    </footer>
</div>
</body>
</html>
