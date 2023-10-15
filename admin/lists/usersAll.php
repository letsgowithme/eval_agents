<?php 
require_once "../../includes/DB.php";

include_once "../../includes/admin_header.php";
include_once "../../includes/admin_navbar.php";
$titre = "Users";
?>
</head>
<body class="body_page">
<div class="d-flex justify-content-between">
<h1>Liste des personnes</h1>    
<button class="btn border" style="background: lightgray;"><a class="fs-4" style="font-weight: bold; color:darkblue; text-decoration: none;" aria-current="page" href="../admin_index.php" id="up">Admin</a></button>
</div>
   
<table class="table table-striped table-hover" width="1000" style="border: 5px solid black; background: lightgray;">

<tr>
  <th>Id</th>
  <th>Nom</th>
  <th>Prénom</th>
  <th>Date de naissance</th>
  <th>Email</th>
  <th>Nationality</th>
  <th>Nome de code</th>
  <th>Type</th>
  <th>Specialités</th>
  <th>Actions</th>
  <th>Actions</th>
</tr>
<?php 
global $dbConnect;
$sql = "SELECT * FROM `user`";
$query = $dbConnect->query($sql);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
$id = $row["id"];
$lastname = $row["lastname"];
$firstname = $row["firstname"];
$birthdate = $row["birthdate"];
$email = $row["email"];
$codeName = $row["codeName"];
$nationality = $row["nationality"];
$userType = $row["userType"];
$specialities = $row["specialities"];
?>
<tr>
   <td><?php echo $id ?></td>
  <td><?php echo  $lastname ?></td>
  <td><?php echo $firstname ?></td>
  <td><?php echo $birthdate ?></td>
  <td><?php echo $email ?></td>
  <td><?php echo $nationality ?></td>
  <td><?php echo $codeName ?></td>
  <td><?php echo $userType ?></td>
  <td><?php echo $specialities ?></td>
  <td><a href="../update/user_update.php?id=<?php echo $id?>">Modifier</a></td>
  <td><a href="delete.php?id=<?php echo $id?>">Supprimer</a></td>
</tr>
<?php } ?>
</table>

<?php include_once "../../includes/footer.php";?>