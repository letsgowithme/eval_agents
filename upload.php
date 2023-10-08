<?php 
session_start();
//on verif si un fichier a été envoyé
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
//on a recu l'image
// verifications:
  // extention et type Mime
  $allowed = [
    "jpg" => "image/jpg",
    "jpeg" => "image/jpeg",
    "png" => "image/png",
    "pdf" => "application/pdf"
  ];
   $filename = $_FILES["image"]["name"];
   $filetype = $_FILES["image"]["type"];
   $filesize = $_FILES["image"]["size"];

   $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
   // on vefir l'absence de l'extention dans les clés de $allowed ou l'absence du type mime dans les valeurs
 if(!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
     //Ici soit l'extention soit le type est incorrect
     die("Erreur: format de l'image incorrecte");
 }
 // ici le type est correct
 // on limite à 1Mo
 if($filesize > 1024 * 1024) {
  die("Erreur: la taille de l'image est trop grande");
 }
 // on génère un nom unique pour l'image
 $newname = md5(uniqid());
 // on génère le chemin complet
 $newfilename = __DIR__ . "/uploads/$newname.$extension";
//  var_dump($_FILES);
// echo $newfilename;
// var_dump(__DIR__);
if(!move_uploaded_file($_FILES["image"]["tmp_name"], $newfilename)) {
die("Erreur: L'upload a échoué");
 }else{
  chmod($newfilename, 0644);
  // echo fileperms($newfilename);
  // chmod($newfilename, 0777);
  echo "<br>L'upload a été effectué avec succès";
 }
//  unlink(__DIR__."/uploads/80c7db0acd50aed0d7d0c2edb7e31885.jpg");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Ajout de fichiers</h1>
  <form method="post" enctype="multipart/form-data">
    <div>
 <label for="fichier">Fichier</label>
 <input type="file" name="image" id="fichier">
 </div>
 <button type="submit">Envoyer</button>
  </form>
</body>
</html>