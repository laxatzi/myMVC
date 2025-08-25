<?php
// TEMP while fixing privileges — switch back to product_db_user later
return [
  'host'     => '127.0.0.1',
  'port'     => 3306,
  'database' => 'product_db',
  'user'     => 'product_db_user',
  'pass'     => 'secret',          // XAMPP default; change if you set one
  'charset'  => 'utf8mb4',
];
