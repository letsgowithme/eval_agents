<?php 
require_once "includes/DB.php";

include_once "includes/header.php";
include_once "includes/navbar.php";
$titre = "Missions";
?>
</head>
<body class="body_page">

    <h1>Liste des missions</h1>
<table class="table table-striped table-hover" width="1000" style="border: 5px solid black; background: lightgray;">

<tr>
  <th>Id</th>
  <th>Title</th>
  <th>Déscription</th>
  <th>Date de debut</th>
  <th>Date de la fin</th>
  <th>Pays</th>
  <th>Status</th>
  <th>Details</th>
</tr>
<?php 
global $dbConnect;
$sql = "SELECT * FROM `mission`";
$query = $dbConnect->query($sql);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
$id = $row["id"];
$title = $row["title"];
$description = $row["description"];
$startDate = $row["startDate"];
$endDate = $row["endDate"];
$country = $row["country"];
$missionStatus = $row["missionStatus"];

?>
<tr>
   <td><?php echo $id ?></td>
  <td><?php echo  $title ?></td>
  <td><?php echo $description ?></td>
  <td><?php echo $startDate ?></td>
  <td><?php echo $endDate ?></td>
  <td><?php echo $country ?></td>
  <td><?php echo $missionStatus ?></td>
  <td><a href="mission_details.php?id=<?php echo $id?>">Details</a></td>
</tr>
<?php } ?>
</table>

<?php include_once "includes/footer.php";?>