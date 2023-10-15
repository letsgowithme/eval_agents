<?php 
require_once "includes/DB.php";
session_start();
include_once "includes/header.php";
// include_once "includes/navbar.php";
$titre = "Missions";

?>
</head>
<body class="body_page">
<div class="container w-75">
<div class="d-flex justify-content-between mt-3 mb-3 mx-2">
<div><h1>Liste de missions</h1></div> 
<div>
<?php if(isset($_SESSION["user"])):
  if($_SESSION["user"]["roles"] < 4 ):
  ?>
 <button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="index.php" id="up">Accueil</a></button>
<?php else:?>
  <button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="admin/admin_index.php" id="up_admin">Admin</a></button>      
<?php endif;
    endif;
?>

</div>
</div>
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