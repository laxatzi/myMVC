<?php

# Database connection

## Dissecting $dsn in the code below:
// ($dsn): A special string that tells PHP how to connect to your database.
// mysql: → we’re using MySQL.
// host=localhost → the database runs on your local machine.
// dbname=product_db → the name of your database.
// charset=utf8 → use UTF-8 encoding (good for handling all kinds of text).
// port=3306 → the default MySQL port.

$dsn = "mysql:host=localhost;dbname=product_db;charset=utf8;port=3306";

## Dissecting the PDO line:
// new PDO(...): Creates a PDO object (PHP Data Object), which is the modern way to connect to databases in PHP.
// 'product_db_user' and 'secret' are the username and password for your DB.
// PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION: This makes sure that if something goes wrong, PHP will throw a clear error instead of silently failing.
// At this point, $pdo is your connection to the database.

$pdo = new PDO($dsn, 'product_db_user', 'secret', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
] );

# Querying the database

// $pdo->query("SELECT * FROM product"): Sends a SQL query to MySQL.
// It says “select all rows from the table called product.”
// $stmt: The result of the query (a statement object).
// $stmt->fetchAll(PDO::FETCH_ASSOC): Fetches all the rows into a PHP array of associative arrays

$stmt = $pdo->query("SELECT * FROM product");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>

</head>
<body>
  <h1>Products</h1>
  <!-- Looping through products -->
  <?php

  // foreach ($products as $product): Go through every row in the $products array.
  // Each $product is one row from the database.
  // Inside the loop, you output HTML that uses the data.


# htmlspecialchars(...)

// This is very important for security.
// If a product name contains special HTML characters (like <script>), htmlspecialchars makes sure it’s displayed as text, not executed as code.
// Example: if the DB had Cool <b>Product</b>,
// Without htmlspecialchars: it would show as Cool Product (HTML bold).
// With htmlspecialchars: it shows literally as Cool <b>Product</b>.
// This prevents cross-site scripting (XSS) attacks.

    foreach ($products as $product): ?>

        <div class="product">
        <h2><?= htmlspecialchars($product['name'])?></h2>
        <p>Description:<?= htmlspecialchars($product['description'])?></p>

        </div>



  <?php endforeach; ?>
</body>
</html>
