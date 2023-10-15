<?php 
require_once "../../includes/DB.php";

include_once "../includes/admin_header.php";
// include_once "../includes/admin_navbar.php";
$titre = "Users";
?>
</head>
<body class="body_page">
  <div class=" mx-4">
  <div class="d-flex justify-content-between mt-3 mb-3 mx-2">
<div><h1>Planques</h1></div> 
<div>
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page"  href="../new/hideout_new.php" id="up">Créer une planque</a></button>
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="missions.php" id="up">Missions</a></button>
   
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="../admin_index.php" id="up">Admin</a></button>
</div>
</div>
   
<table class="table table-striped table-hover" 
width="1000" style="border: 5px solid black; background: lightgray;">

<tr>
  <th>Id</th>
  <th>Code</th>
  <th>Adresse</th>
  <th>Type</th>
  <th>Pays</th>
  <th>Actions</th>
  <th>Actions</th>
</tr>
<?php 
global $dbConnect;
$sql = "SELECT * FROM `hideout`";
$query = $dbConnect->query($sql);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
$id = $row["id"];
$hideoutCode = $row["hideoutCode"];
$hideoutAddress = $row["hideoutAddress"];
$hideoutType = $row["hideoutType"];
$country = $row["country"];

?>
<tr>
   <td><?php echo $id ?></td>
  <td><?php echo  $hideoutCode ?></td>
  <td><?php echo $hideoutAddress ?></td>
  <td><?php echo $hideoutType ?></td>
  <td><?php echo $country ?></td>
  <td><a href="../update/hideout_update.php?id=<?php echo $id?>">Modifier</a></td>
  <td><a href="../update/hideout_delete.php?id=<?php echo $id?>">Supprimer</a></td>
</tr>
<?php } ?>
</table>
</div>
<?php include_once "../../includes/footer.php";?>