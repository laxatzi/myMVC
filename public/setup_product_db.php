<?php
/**
 * Run this ONCE to set up product_db + user.
 * Usage (PowerShell from project root):
 *   & "C:\xampp\php\php.exe" scripts\setup_product_db.php
 */

declare(strict_types=1);

$rootUser = 'root';
$rootPass = ''; // XAMPP default = empty
$host     = '127.0.0.1'; // use TCP, not 'localhost' (avoids socket issues)
$port     = 3306;

// Database and user info
$dbName   = 'product_db';
$dbUser   = 'product_db_user';
$dbPass   = 'secret'; // change if you like

try {
    // Connect as root (to MySQL server, no DB yet)
    $pdo = new PDO(
        "mysql:host=$host;port=$port;charset=utf8mb4",
        $rootUser,
        $rootPass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    // 1) Create the database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    echo "[OK] Database `$dbName` ensured.\n";

    // 2) Create the user if not exists
    $pdo->exec("CREATE USER IF NOT EXISTS '$dbUser'@'localhost' IDENTIFIED BY '$dbPass'");
    echo "[OK] User `$dbUser` ensured.\n";

    // 3) Grant privileges on the new DB to that user
    $pdo->exec("GRANT ALL PRIVILEGES ON `$dbName`.* TO '$dbUser'@'localhost'");
    $pdo->exec("FLUSH PRIVILEGES");
    echo "[OK] Privileges granted.\n";

    // 4) Connect as the new user to verify
    $pdoTest = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "[SUCCESS] Connected as $dbUser to $dbName 🎉\n";

} catch (Throwable $e) {
    fwrite(STDERR, "[ERROR] " . $e->getMessage() . "\n");
    exit(1);
}
