<?php 
require_once "includes/DB.php";

include_once "includes/header.php";
include_once "includes/navbar.php";
$titre = "Missions";
?>
</head>
<body class="body_page">
<div class="container w-75">
    <h1>Liste des agents</h1>
<table class="table table-striped table-hover text-center" width="1000" style="border: 5px solid black; background: lightgray;">

<tr>
<th class="w-50 hidden">Id</th>
<th class="w-50">Lastname</th>
<th class="w-50">Firstname</th>
<th class="w-50">Date de naissance</th>
<th class="w-50">Code d'identification</th>
<th class="w-50">Nationalité</th>
<th class="w-50">Spécialité</th>
  <th class="w-25">Détails</th>
</tr>
<?php 
global $dbConnect;
$sql = "SELECT * FROM `user` WHERE `userType` = `agent`";
$query = $dbConnect->query($sql);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $userId = $row["id"];
  $lastname = $row["lastname"];
  $firstname = $row["firstname"];
  $birthdate = $row["birthdate"];
  $codeName = $row["codeName"];
  $nationality = $row["nationality"];
  $speciality = $row["speciality"];
?>
<tr>
<td class="hidden"><?php echo  $userId ?></td>
<td><?php echo  $lastname ?></td>
<td><?php echo  $firstname ?></td>
<td><?php echo  $birthdate ?></td>
<td><?php echo  $codeName ?></td>
<td><?php echo  $nationality ?></td>
<td><?php echo  $speciality ?></td>
<td><a href="mission_details.php?id=<?php echo $id?>">Details</a></td>
</tr>
<?php } ?>
</table>

</div>
<?php include_once "includes/footer.php";?>