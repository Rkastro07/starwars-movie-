<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}

include_once('../../functions/functions.php');
$db = dbLink();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
        // Validate file extension
        $fileInfo = pathinfo($_FILES['csv_file']['name']);
        if (strtolower($fileInfo['extension']) !== 'csv') {
            $message = 'Please upload a CSV file.';
        } else {
            // Open the CSV file
            if (($handle = fopen($_FILES['csv_file']['tmp_name'], 'r')) !== false) {
                $movies = array();
                // Read header row (optional)
                $header = fgetcsv($handle, 1000, ",");
                // Loop through each subsequent row
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    // Ensure there are at least 4 columns
                    if (count($data) < 4) {
                        continue;
                    }
                    $movies[] = [
                        'title'        => $data[0],
                        'release_year' => $data[1],
                        'director'     => $data[2],
                        'synopsis'     => $data[3]
                    ];
                }
                fclose($handle);
                
                // Call the batch insert function (defined in functions.php)
                if (batchInsertMovies($db, $movies)) {
                    $message = "Batch insert of movies successful!";
                } else {
                    $message = "Batch insert failed.";
                }
            } else {
                $message = "Could not open the CSV file.";
            }
        }
    } else {
        $message = "Please select a CSV file to upload.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Batch Add Movies - Admin</title>
    <link rel="stylesheet" href="../../style/css.css">
</head>
<body class="movies-page">
    <div class="site-wrapper">
        <header>
            <h1>Batch Add Movies</h1>
        </header>
        <nav>
            <ul>
                <li><a href="../../index.php">Home (Site)</a></li>
                <li><a href="index.php">Movies List</a></li>
                <li><a href="../dashboard.php">Admin Dashboard</a></li>
                <li><a href="batchAddMovies.php">Batch Add Movies</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <main>
            <?php if ($message != ''): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <form action="batchAddMovies.php" method="post" enctype="multipart/form-data">
                <p>
                    <label for="csv_file">Upload CSV File:</label><br>
                    <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
                </p>
                <p>
                    <input type="submit" value="Upload and Insert Movies">
                </p>
            </form>
            <p>
                <em>CSV format: title,release_year,director,synopsis</em>
            </p>
        </main>
        <footer>
            <p>&copy; 2025 Star Wars Universe - Admin</p>
        </footer>
    </div>
</body>
</html>
