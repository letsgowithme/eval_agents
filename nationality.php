<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'agents');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'agents_db');
// define('DB_TABLE', 'nationality');
 $DSN = "mysql:host=".DB_HOST.";dbname=".DB_NAME;


try {
  $dbConnect = new PDO($DSN, DB_USER, DB_PASSWORD);
  $dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbConnect->exec("SET NAMES utf8");
  echo '<p class="text-light m-4 fw-bold fs-5">Connexion réussie</p>';
  // echo "<h2>Nationalités</h2><ol>"; 
  // foreach($dbConnect->query("SELECT title FROM $table") as $row) {
  //   echo "<li>" . $row['title'] . "</li>";
  // }
  // echo "</ol>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//on recup la liste des users

$sql = "SELECT * FROM `nationality`";
//on exec la requete
$requete = $dbConnect->query($sql);

//on recup les données(fetch ou fetchAll)
$nation = $requete->fetchALL(PDO::FETCH_ASSOC);
// echo "<pre>";
// var_dump($nation);
// echo "</pre>"; 

$sql = "INSERT INTO `nationality`(`title`) 
   VALUES('nationalityName')";
$requete = $dbConnect->query($sql);

$sql = "UPDATE `nationality` SET `title` = 'turc' WHERE `id` 14";
$requete = $dbConnect->query($sql);
   
//supprimer nationality
$sql = "DELETE FROM `nationality` WHERE `id` > 10";
$requete = $dbConnect->query($sql);

//savoir combien de lignes etaient supprimées

echo $requete->rowCount();





// if (isset($_POST["Submit"])) {
//   if(!empty($_POST["nationalityName"])) {
//    $nationalityName = $_POST["nationalityName"];
//    global $dbConnect;
//    $sql = "INSERT INTO nationality(title) 
//    VALUES(':nationalityNamE')";
//    $stmt = $dbConnect->prepare($sql);
//    $stmt->bindValue(':nationalityNamE',$nationalityName);
//    $Execute = $stmt->execute();
//    if ($Execute){
//     echo '<p class="success">La nationalté a été créé!!</p>';
//    }else {
//     echo '<p class="error">Une erreur</p>';
//    }
//    }else {
//     echo '<p class="danger fw-bold m-4 fs-4 bg-danger p-3 w-50 text-center">Veuillez entrer le nom de nationalité</p>';
//   }
// }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nationalité</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="style/style.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="logo.png">
</head>

<body class="body_page">
  <div class="container">
<form class="form" action="nationality.php" method="post">
  <div class="mb-3">
    <label for="nationalityName" class="form-label fw-bold my-4 fs-2" style="color: #01013d;">Nationalité</label>
    <input type="text" class="form-control w-50" name="nationalityName" value="">
  <button type="submit" class="btn btn-primary my-4 fs-4 fw-bold" name="Submit">Créer</button>
</form>
<div class="text-center fs-4 fw-bold">
<button type="button" class="login my-4" data-toggle="tooltip" data-placement="top"><a href="index.php">Accueil</button>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>