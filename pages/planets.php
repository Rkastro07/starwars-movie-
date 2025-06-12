<?php
// pages/planets.php
include_once('../functions/functions.php');
$db = dbLink();

$planets = listPlanets($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Star Wars Planets</title>
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
        <img src="../img/planets.jpg" alt="Planets">
      </div>
      <h2>Planets</h2>
      <p>
        The galaxy boasts an incredible range of worlds, each with unique 
        climates, cultures, and histories:
      </p>

      <?php if (!empty($planets)): ?>
        <ul>
          <?php foreach($planets as $pl): ?>
            <li>
              <strong><?php echo $pl['planet_name']; ?></strong>
              (Região: <?php echo $pl['region']; ?>)<br>
              <?php
                // Exibir parte da descrição ou toda, conforme desejar
                echo htmlspecialchars($pl['description']);
              ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>Nenhum planeta encontrado no banco.</p>
      <?php endif; ?>
    </main>

    <footer>
      <p>&copy; 2025 Star Wars Universe</p>
    </footer>
  </div>
</body>
</html>
