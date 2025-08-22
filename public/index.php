<?php

require "model.php";

$model = new Model();
$products = $model->getData();

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
