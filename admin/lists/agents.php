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
<div><h1>Agents</h1></div> 
<div>
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="usersAll.php" id="up">Utilisateurs</a></button>
   
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="../admin_index.php" id="up">Admin</a></button>
</div>
</div>
   
<table class="table table-striped table-hover" 
width="1000" style="border: 5px solid black; background: lightgray;">

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
$sql = "SELECT * FROM `user` WHERE `userType` = 'agent'";
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
$user_specialities = $row["specialities"];


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
  <td class="text-center"><?php echo $user_specialities ? $user_specialities : '-' ?></td>
  <td><a href="../update/user_update.php?id=<?php echo $id?>">Modifier</a></td>
  <td><a href="../update/user_delete.php?id=<?php echo $id?>">Supprimer</a></td>
</tr>
<?php } ?>
</table>
</div>
<?php include_once "../../includes/footer.php";?>