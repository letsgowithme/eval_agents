<?php 
$missions=true;
require_once "includes/DB.php";
session_start();
include_once "includes/header.php";
include_once "includes/navbar.php";
$titre = "Missions";

?>
</head>
<body class="body_list">
<div class="container w-75" style="height: 85svh;">
<div class="d-flex justify-content-between mt-3 mb-3 mx-2">
<div><h1>Liste de missions</h1>
<a href="admin/new/mission_new.php" class="btn btn-primary">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
  <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg>
</a> </div> 
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
aria-current="page" href="admin/admin_index.php" id="up_admin">Tableau de bord</a></button>      
<?php endif;
    endif;
?>
</div>
</div>

<table id="datatable" class="display" style="border: 3px solid black; background: lightgray;">
    <thead class="my-4">
         <tr>
            <th class="w-50 hidden">Id</th>
            <th class="w-50 text-center">Titre</th>
            <?php if(isset($_SESSION["user"])):
              if($_SESSION["user"]["roles"] > 4 ):
                ?>
            <th class="w-25 text-center">Actions</th>
            <?php endif; 
            endif;
            ?>
            <th class="w-25 text-center">Détails</th>
            
         </tr>
      </thead>
  
 <tbody>       
 <?php 
global $dbConnect;
$sql = "SELECT * FROM `mission`";
$query = $dbConnect->query($sql);
while ($row = $query->fetch(PDO::FETCH_ASSOC)):
$id = $row["id"];
$title = $row["title"];
?>
<tr>
<td class="hidden"><?php echo  $id ?></td>
<td class="text-center"><?php echo  $title ?></td>
<?php if(isset($_SESSION["user"])):
              if($_SESSION["user"]["roles"] > 4 ):
                ?>
<td class="text-center">
<a class="btn btn-success" href="admin/update/mission_update.php?id=<?php echo $id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
</svg></a>
<a class="btn btn-danger" href="../update/mission_delete.php?id=<?php echo $id?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
</svg></a></td>
<?php endif; 
            endif;
            ?>
<td class="text-center"><a href="mission_details.php?id=<?php echo $id?>">Details</a></td>
</tr> 
<?php endwhile ?>
</tbody>   
</table>
</div>
<?php include_once "includes/footer.php";?>