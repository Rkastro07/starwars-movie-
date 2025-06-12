<?php
// pages/summary.php
include_once('../functions/functions.php');
$db = dbLink();

$summaries = listSummaries($db);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Star Wars Summary</title>
  <link rel="stylesheet" href="../style/css.css">
</head>

<!-- Classe .summary-page para o fundo específico dessa página -->
<body class="summary-page">
    <div class="site-wrapper">

  <!-- Exemplo: caixa de imagem no canto inferior direito -->

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
        <img src="../img/2.jpg" alt="Star Wars Summary">
      </div>
    <h2>Summary</h2>
    <?php if (!empty($summaries)): ?>
        <?php foreach ($summaries as $summary): ?>
            <section>
                <h3><?php echo htmlspecialchars($summary['era_title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($summary['summary_text'])); ?></p>
            </section>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum resumo encontrado no banco de dados.</p>
    <?php endif; ?>
    <!-- Outra CTA (opcional) -->
    
  </main>

  <footer>
    <p>&copy; 2025 Star Wars Universe</p>
  </footer>
</div>
</body>
</html>
