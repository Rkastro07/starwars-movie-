<?php
// pages/ships.php
include_once('../functions/functions.php');
$db = dbLink();

$ships = listShips($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Star Wars Ships</title>
  <link rel="stylesheet" href="../style/css.css">
</head>
<body>
  <header>
    <h1>Star Wars Universe</h1>
  </header>
  <div class="site-wrapper">
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
          <img src="../img/ships.jpg" alt="Millennium Falcon">
      </div>
      <h2>Ships</h2>
      <p>
        Star Wars is known for its iconic spacecraft, from humble freighters 
        to massive Star Destroyers:
      </p>
      <?php if (!empty($ships)): ?>
        <ul>
          <?php foreach($ships as $s): ?>
            <li>
              <strong><?php echo $s['ship_name']; ?></strong> 
              (Modelo: <?php echo $s['model']; ?>)
              <br>
              <!-- Exibir um pedaço da descrição, se quiser -->
              <?php echo htmlspecialchars($s['description']); ?>
            </li>
            <br>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>Nenhuma nave encontrada no banco de dados.</p>
      <?php endif; ?>
    </main>

    <footer>
      <p>&copy; 2025 Star Wars Universe</p>
    </footer>
  </div>
</body>
</html>
