<?php

  class Model {
  public function getData(): array {

   $cfg = require __DIR__ . '/../config/database.php';




    // # Database connection

    // $dsn = "mysql:host=localhost;dbname=product_db;charset=utf8;port=3306";

    // // new PDO(...): Creates a PDO object (PHP Data Object), which is the modern way to connect to databases in PHP.
    // // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION: This makes sure that if something goes wrong, PHP will throw a clear error instead of silently failing.


    // $pdo = new PDO($dsn, 'product_db_user', 'secret', [
    //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // ] );

    // // $pdo->query("SELECT * FROM product"): Sends a SQL query to MySQL.
    // // $stmt: The result of the query (a statement object).
    // // $stmt->fetchAll(PDO::FETCH_ASSOC): Fetches all the rows into a PHP array of associative arrays

    // $stmt = $pdo->query("SELECT * FROM product");
    // return $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dsn = sprintf(
  'mysql:host=%s;port=%d;dbname=%s;charset=%s',
  $cfg['host'], $cfg['port'], $cfg['database'], $cfg['charset']
);

$pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);
  }

  }