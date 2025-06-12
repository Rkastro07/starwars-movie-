<?php 
// admin/dashboard.php
session_start();

// Checks if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in, display the admin panel
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard - Star Wars</title>
        <link rel="stylesheet" href="../style/css.css">
    </head>
    <body class="admin-dashboard-page">
    <div class="site-wrapper">
        <header>
            <h1>Admin Dashboard</h1>
        </header>
    
        <nav>
            <ul>
                <li><a href="../index.php">Home (Site)</a></li>
                <li><a href="dashboard.php">Admin Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    
        <main>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>Here you can manage different areas of your website.</p>
    
            <ul>
                <li>
                    <a href="movies/index.php">Manage Movies</a>
                </li>
                <li>
                    <a href="planets/index.php">Manage Planets</a>
                </li>
                <li>
                    <a href="ships/index.php">Manage Ships</a>
                </li>
                <li>
                    <a href="alienraces/index.php">Manage Alien Races</a>
                </li>
                <li>
                    <a href="characters/index.php">Manage Characters</a>
                </li>
                <li>
                    <a href="summary/index.php">Manage Summary</a>
                </li>
                <li>
                    <a href="aspects/index.php">Manage Force Aspects</a>
                </li>
                <li>
                    <a href="skills/index.php">Manage Skills</a>
                </li>
                <!-- In the future, add other modules like Species, etc. -->
            </ul>
        </main>
    
        <footer>
            <p>&copy; 2025 Star Wars Universe - Admin</p>
        </footer>
    </div>
    </body>
    </html>
    <?php
} else {
    // User is not logged in, process login if the form was submitted
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve form data
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
    
        // Check credentials
        if ($username === 'adm' && $password === '12345') {
            // Correct credentials, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
    
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            // Invalid credentials
            $error = "Incorrect username or password.";
        }
    }
    // Display login form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Login - Star Wars</title>
        <link rel="stylesheet" href="../style/css.css">
    </head>
    <body class="admin-login-page">
    <div class="site-wrapper">
        <header>
            <h1>Admin Login</h1>
        </header>
    
        <nav>
            <ul>
            <li><a href="../index.php">Home (Site)</a></li>
            <li><a href="dashboard.php">Admin Dashboard</a></li>
            </ul>
        </nav>
    
        <main>
            <?php if (!empty($error)): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form action="dashboard.php" method="post">
                <p>
                    <label for="username">Username:</label><br>
                    <input type="text" name="username" id="username" required>
                </p>
                <p>
                    <label for="password">Password:</label><br>
                    <input type="password" name="password" id="password" required>
                </p>
                <p>
                    <input type="submit" value="Login">
                </p>
            </form>
        </main>
    
        <footer>
            <p>&copy; 2025 Star Wars Universe - Admin</p>
        </footer>
    </div>
    </body>
    </html>
    <?php
}
?>
