<?php
/**
 * Arquivo: functions.php
 * Descrição: Funções de conexão e manipulação do banco starwars, tabela movies
 */

/**
 * Faz a conexão com o banco de dados usando PDO.
 * Ajuste $db_user e $db_pass ao seu ambiente.
 */
function dbLink() {
    $db_host = 'localhost';
    $db_user = 'mri';      // Ajuste conforme seu ambiente
    $db_pass = '12345';          // Ajuste conforme seu ambiente
    $db_name = 'starwars';  // Nome do banco

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        // Modo de tratamento de erros
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
        exit;
    }
    return $db;
}

/**
 * Insere um novo filme na tabela movies
 */
function insertMovie($db, $title, $release_year, $director, $synopsis) {
    $sql = "INSERT INTO movies (title, release_year, director, synopsis)
            VALUES (:title, :release_year, :director, :synopsis)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':release_year', $release_year);
    $stmt->bindParam(':director', $director);
    $stmt->bindParam(':synopsis', $synopsis);
    return $stmt->execute(); // Retorna true/false
}

/**
 * Batch inserts multiple movies at once.
 * @param PDO $db Database connection.
 * @param array $movies An array of associative arrays. Each element should have keys: 'title', 'release_year', 'director', 'synopsis'.
 * @return bool True on success, false on failure.
 */
function batchInsertMovies($db, array $movies) {
    // SQL query for inserting one movie.
    $sql = "INSERT INTO movies (title, release_year, director, synopsis)
            VALUES (:title, :release_year, :director, :synopsis)";
    
    try {
        // Begin transaction.
        $db->beginTransaction();
        // Prepare the statement once.
        $stmt = $db->prepare($sql);
        
        foreach ($movies as $movie) {
            // Validate that required keys exist.
            if (!isset($movie['title'], $movie['release_year'], $movie['director'], $movie['synopsis'])) {
                // Roll back if any movie is missing required fields.
                $db->rollBack();
                throw new Exception("One of the movie records is missing required fields.");
            }
            // Bind values for this record.
            $stmt->bindValue(':title', $movie['title']);
            $stmt->bindValue(':release_year', $movie['release_year']);
            $stmt->bindValue(':director', $movie['director']);
            $stmt->bindValue(':synopsis', $movie['synopsis']);
            // Execute the prepared statement.
            $stmt->execute();
        }
        // Commit the transaction.
        $db->commit();
        return true;
    } catch (Exception $e) {
        // Roll back the transaction if an error occurs.
        $db->rollBack();
        echo "Batch insert failed: " . $e->getMessage();
        return false;
    }
}

/**
 * Lista todos os filmes para exibir na admin-page1 ou em qualquer lugar
 */
function listMovies($db) {
    $sql = "SELECT * FROM movies ORDER BY release_year ASC";
    $stmt = $db->query($sql);
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $movies;
}

/**
 * Busca dados de um filme pelo ID
 */
function getMovieById($db, $id) {
    $sql = "SELECT * FROM movies WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza os campos de um filme no banco
 */
function updateMovie($db, $id, $title, $release_year, $director, $synopsis) {
    $sql = "UPDATE movies
            SET title = :title,
                release_year = :release_year,
                director = :director,
                synopsis = :synopsis
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':release_year', $release_year);
    $stmt->bindParam(':director', $director);
    $stmt->bindParam(':synopsis', $synopsis);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * Deleta um filme pelo ID
 */
function deleteMovie($db, $id) {
    $sql = "DELETE FROM movies WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}


function insertPlanet($db, $planet_name, $region, $description) {
    $sql = "INSERT INTO planets (planet_name, region, description)
            VALUES (:planet_name, :region, :description)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':planet_name', $planet_name);
    $stmt->bindParam(':region', $region);
    $stmt->bindParam(':description', $description);
    return $stmt->execute();
}

/**
 * Lista todos os planetas
 */
function listPlanets($db) {
    $sql = "SELECT * FROM planets ORDER BY planet_name ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Retorna um planeta pelo ID
 */
function getPlanetById($db, $id) {
    $sql = "SELECT * FROM planets WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza um planeta
 */
function updatePlanet($db, $id, $planet_name, $region, $description) {
    $sql = "UPDATE planets
            SET planet_name = :planet_name,
                region = :region,
                description = :description
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':planet_name', $planet_name);
    $stmt->bindParam(':region', $region);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * Deleta um planeta
 */
function deletePlanet($db, $id) {
    $sql = "DELETE FROM planets WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}


function insertShip($db, $ship_name, $model, $description) {
    $sql = "INSERT INTO ships (ship_name, model, description)
            VALUES (:ship_name, :model, :description)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':ship_name', $ship_name);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':description', $description);
    return $stmt->execute();
}

/**
 * Lista todas as naves (ships)
 */
function listShips($db) {
    $sql = "SELECT * FROM ships ORDER BY ship_name ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Retorna uma nave pelo ID
 */
function getShipById($db, $id) {
    $sql = "SELECT * FROM ships WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza dados de uma nave
 */
function updateShip($db, $id, $ship_name, $model, $description) {
    $sql = "UPDATE ships
            SET ship_name = :ship_name,
                model = :model,
                description = :description
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':ship_name', $ship_name);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * Deleta uma nave
 */
function deleteShip($db, $id) {
    $sql = "DELETE FROM ships WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

// ... (Fim do arquivo, mantendo suas outras funções)
function insertAlienRace($db, $race_name, $homeworld, $traits) {
    $sql = "INSERT INTO alienraces (race_name, homeworld, traits)
            VALUES (:race_name, :homeworld, :traits)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':race_name', $race_name);
    $stmt->bindParam(':homeworld', $homeworld);
    $stmt->bindParam(':traits', $traits);
    return $stmt->execute();
}

/**
 * Lista todas as raças alienígenas
 */
function listAlienRaces($db) {
    $sql = "SELECT * FROM alien_races ORDER BY race_name ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Obtém uma raça alienígena pelo ID
 */
function getAlienRaceById($db, $id) {
    $sql = "SELECT * FROM alien_races WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza uma raça alienígena
 */
function updateAlienRace($db, $id, $race_name, $homeworld, $traits) {
    $sql = "UPDATE alien_races
            SET race_name = :race_name,
                homeworld = :homeworld,
                traits = :traits
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':race_name', $race_name);
    $stmt->bindParam(':homeworld', $homeworld);
    $stmt->bindParam(':traits', $traits);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * Deleta uma raça alienígena
 */
function deleteAlienRace($db, $id) {
    $sql = "DELETE FROM alien_races WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/* --- Fim das Funções para "alienraces" --- */

function insertCharacter($db, $name, $affiliation, $details) {
    $sql = "INSERT INTO characters (name, affiliation, details)
            VALUES (:name, :affiliation, :details)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':affiliation', $affiliation);
    $stmt->bindParam(':details', $details);
    return $stmt->execute();
}

/**
 * Lista todos os personagens (characters)
 */
function listCharacters($db) {
    $sql = "SELECT * FROM characters ORDER BY name ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Obtém um personagem pelo ID
 */
function getCharacterById($db, $id) {
    $sql = "SELECT * FROM characters WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza um personagem
 */
function updateCharacter($db, $id, $name, $affiliation, $details) {
    $sql = "UPDATE characters
            SET name = :name,
                affiliation = :affiliation,
                details = :details
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':affiliation', $affiliation);
    $stmt->bindParam(':details', $details);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * Deleta um personagem
 */
function deleteCharacter($db, $id) {
    $sql = "DELETE FROM characters WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/* --- Fim das Funções para "characters" --- */
/* --- Novas Funções para "summary" --- */

/**
 * Insere um novo resumo
 */
function insertSummary($db, $era_title, $summary_text) {
    $sql = "INSERT INTO summary (era_title, summary_text)
            VALUES (:era_title, :summary_text)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':era_title', $era_title);
    $stmt->bindParam(':summary_text', $summary_text);
    return $stmt->execute();
}

/**
 * Lista todos os resumos
 */
function listSummaries($db) {
    $sql = "SELECT * FROM summary ORDER BY id ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Obtém um resumo pelo ID
 */
function getSummaryById($db, $id) {
    $sql = "SELECT * FROM summary WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza um resumo
 */
function updateSummary($db, $id, $era_title, $summary_text) {
    $sql = "UPDATE summary
            SET era_title = :era_title,
                summary_text = :summary_text
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':era_title', $era_title);
    $stmt->bindParam(':summary_text', $summary_text);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * Deleta um resumo
 */
function deleteSummary($db, $id) {
    $sql = "DELETE FROM summary WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/* --- Fim das Funções para "summary" --- */


function insertAspect($db, $aspect, $definition) {
    $sql = "INSERT INTO aspects (aspect, definition)
            VALUES (:aspect, :definition)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':aspect', $aspect);
    $stmt->bindParam(':definition', $definition);
    return $stmt->execute();
}

/**
 * Lista todos os aspectos da Força
 */
function listAspects($db) {
    $sql = "SELECT * FROM aspects ORDER BY id ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Obtém um aspecto pelo ID
 */
function getAspectById($db, $id) {
    $sql = "SELECT * FROM aspects WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza um aspecto da Força
 */
function updateAspect($db, $id, $aspect, $definition) {
    $sql = "UPDATE aspects
            SET aspect = :aspect,
                definition = :definition
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':aspect', $aspect);
    $stmt->bindParam(':definition', $definition);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * Deleta um aspecto da Força
 */
function deleteAspect($db, $id) {
    $sql = "DELETE FROM aspects WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/* --- Fim das Funções para "aspects" --- */


/* --- Novas Funções para "skills" --- */

/**
 * Insere uma nova habilidade
 */
function insertSkill($db, $name, $skill, $about) {
    $sql = "INSERT INTO skills (name, skill, about)
            VALUES (:name, :skill, :about)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':skill', $skill);
    $stmt->bindParam(':about', $about);
    return $stmt->execute();
}

/**
 * Lista todas as habilidades
 */
function listSkills($db) {
    $sql = "SELECT * FROM skills ORDER BY id ASC";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Obtém uma habilidade pelo ID
 */
function getSkillById($db, $id) {
    $sql = "SELECT * FROM skills WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza uma habilidade
 */
function updateSkill($db, $id, $name, $skill, $about) {
    $sql = "UPDATE skills
            SET name = :name,
                skill = :skill,
                about = :about
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':skill', $skill);
    $stmt->bindParam(':about', $about);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * Deleta uma habilidade
 */
function deleteSkill($db, $id) {
    $sql = "DELETE FROM skills WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/* --- Fim das Funções para "skills" --- */
?>

