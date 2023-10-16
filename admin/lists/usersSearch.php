<?php 
require_once "../../includes/DB.php";
include_once "../includes/admin_header.php";
// include_once "../includes/admin_navbar.php";
$titre = "Search users";
?>
</head>
<body class="body_page" >
  <div class=" mx-4">
    <div class="d-flex justify-content-between mt-3 mb-3 mx-2">
      <!-- Recherche d'utilisateurs -->
    <h1>Recherche d'utilisateurs</h1>
    <div class="">
      <fieldset>
        <form action="usersSearch.php" method="GET">
        <input type="text" name="search" value="" style="width: 240px;" placeholder="Par type: agent, cible, contact">
        <input type="submit" name="searchBtn" value="Rechercher">
        </form>
      </fieldset>
    </div>
</div>
<table class="table table-striped table-hover" 
    width="1000" style="border: 5px solid black; background: lightgray;">

<tr>
  <th>Id</th>
  <th>Prénom</th>
  <th>Nom</th>
  <th>Date de naissance</th>
  <th>Email</th>
  <th>Nationality</th>
  <th>Nome de code</th>
  <th>Type</th>
  <th>Specialités</th>
</tr>
<?php

if(isset($_GET['searchBtn'])){
  global $dbConnect;
  $search = $_GET['search'];
  $sql = "SELECT * FROM `user` WHERE userType=:searcH";
  $query = $dbConnect->prepare($sql);
  $query->bindValue(':searcH',$search);
  $query->execute();
 
  while($row = $query->fetch()) {
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
<!-- table avec resultats de recherche -->

<tr>
  <td><?php echo $id ?></td>
  <td><?php echo $firstname ?></td>
  <td><?php echo  $lastname ?></td>
  <td><?php echo $birthdate ?></td>
  <td><?php echo $email ?></td>
  <td><?php echo $nationality ?></td>
  <td><?php echo $codeName ?></td>
  <td><?php echo $userType ?></td>
  <td class="text-center"><?php echo $specialities ? $specialities : '-' ?></td>
</tr>

<?php
  }
}
?>
</table>

</div>
</div>
<div style="position: fixed; bottom: 0;">
<?php include_once "../../includes/footer.php";?>


