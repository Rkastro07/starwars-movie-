<?php
// pages/characters.php
include_once('../functions/functions.php');
$db = dbLink();

$characters = listCharacters($db);
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
        <img src="../img/3.jpg" alt="Star Wars Characters">
      </div>
    <h2>Characters</h2>
    <p>
      The Star Wars saga is rich with diverse characters, each contributing 
      uniquely to the story:
    </p>

    <?php if (!empty($characters)): ?>
        <ul>
          <?php foreach($characters as $char): ?>
            <li>
              <strong><?php echo htmlspecialchars($char['name']); ?></strong>
              (Afilição: <?php echo htmlspecialchars($char['affiliation']); ?>)
              <br>
              <?php echo htmlspecialchars($char['details']); ?>
            </li>
            <br>
          <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum personagem encontrado no banco de dados.</p>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; 2025 Star Wars Universe</p>
  </footer>
</div>
</body>
</html>
