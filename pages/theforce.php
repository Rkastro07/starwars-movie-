<?php
// pages/theforce.php
include_once('../functions/functions.php');
$db = dbLink();

// Obtém os dados das tabelas aspects, characters e skills
$aspects = listAspects($db);
$characters = listCharacters($db);
$skills = listSkills($db);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>The Force</title>
  <link rel="stylesheet" href="../style/css.css">
</head>

<!-- Use a classe .theforce-page -->
<body class="theforce-page">
    <div class="site-wrapper">

  <!-- Uma imagem no bottom-left, por exemplo -->

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
        <img src="../img/1.jpg" alt="The Force">
      </div>
    <h2>The Force</h2>
    <p>
      The Force is an energy field created by all living things. 
      It surrounds us, penetrates us, and binds the galaxy together.
      Force-sensitive individuals can harness its power to perform 
      incredible feats.
    </p>

    <!-- Seção de Aspectos da Força -->
    <section>
        <h3>Aspects of the Força</h3>
        <?php if (!empty($aspects)): ?>
            <ul>
                <?php foreach($aspects as $aspect): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($aspect['aspect']); ?></strong>: 
                        <?php echo nl2br(htmlspecialchars($aspect['definition'])); ?>
                    </li>
                    <br>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum aspecto encontrado.</p>
        <?php endif; ?>
    </section>

    <!-- Seção de Personagens -->
    <section>
        <h3>Characters Influentes</h3>
        <?php if (!empty($characters)): ?>
            <ul>
                <?php foreach($characters as $char): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($char['name']); ?></strong>
                        (<?php echo htmlspecialchars($char['affiliation']); ?>)
                        <br>
                        <?php echo nl2br(htmlspecialchars($char['details'])); ?>
                    </li>
                    <br>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum personagem encontrado.</p>
        <?php endif; ?>
    </section>

    <!-- Seção de Habilidades -->
    <section>
        <h3>Habilities Related to the Force</h3>
        <?php if (!empty($skills)): ?>
            <ul>
                <?php foreach($skills as $skill): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($skill['skill']); ?></strong>
                        (<?php echo htmlspecialchars($skill['name']); ?>)
                        <br>
                        <?php echo nl2br(htmlspecialchars($skill['about'])); ?>
                    </li>
                    <br>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhuma habilidade encontrada.</p>
        <?php endif; ?>
    </section>

    <!-- Outra CTA (opcional) -->
    
  </main>

  <footer>
    <p>&copy; 2025 Star Wars Universe</p>
  </footer>
</div>
</body>
</html>
