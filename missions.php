<?php 
require_once "includes/DB.php";

include_once "includes/header.php";
include_once "includes/navbar.php";
$titre = "Missions";
?>
</head>
<body class="body_page">
<div class="container w-75">
    <h1>Liste des missions</h1>
<table class="table table-striped table-hover text-center" width="1000" style="border: 5px solid black; background: lightgray;">

<tr>
<th class="w-50 hidden">Id</th>
<th class="w-50">Titre</th>
  <th class="w-25">Détails</th>
</tr>
<?php 
global $dbConnect;
$sql = "SELECT * FROM `mission`";
$query = $dbConnect->query($sql);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
$id = $row["id"];
$title = $row["title"];
?>
<tr>
<td class="hidden"><?php echo  $id ?></td>
<td><?php echo  $title ?></td>
<td><a href="mission_details.php?id=<?php echo $id?>">Details</a></td>
</tr>
<?php } ?>
</table>

</div>
<?php include_once "includes/footer.php";?>