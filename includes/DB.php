<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'agents');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'agents_db');
 $DSN = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

try {
  $dbConnect = new PDO($DSN, DB_USER, DB_PASSWORD);
  $dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbConnect->exec("SET NAMES utf8");
  echo '<p class="text-light m-4">Connexion réussie à la DB</p>';
  // echo "<h2>Nationalités</h2><ol>"; 
  // foreach($dbConnect->query("SELECT title FROM $table") as $row) {
  //   echo "<li>" . $row['title'] . "</li>";
  // }
  // echo "</ol>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
