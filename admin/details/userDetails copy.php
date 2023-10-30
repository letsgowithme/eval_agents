<?php 
$user_details=true;
//on demarre la session php

//on verifie s'il ya un id
if (!isset($_GET["id"]) || empty($_GET["id"])){
  header("Location: user_details.php");
  exit;
}

$id = $_GET["id"];
require_once "../../includes/DB.php";
$sql = "SELECT * FROM user WHERE id = '$id'";
$query = $dbConnect->query($sql);
$query->execute();
$row = $query->fetch();
$userType = $row['userType'];


$sql1 = "SELECT * FROM user_speciality WHERE userId='$id'";
$query1 = $dbConnect->query($sql1);

//ici on a la nationalité



include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";

?>
<link rel="stylesheet" href="../../style/style_in_ad.css">
<link rel="stylesheet" href="../../style/style.css">

</head>
<div class="body_page_new py-4">
 
<div style="max-width: 70%!important;">
<h1 style="color: #1c1c22; background: #bdbdc2;">Utilisateur numéro  <?= strip_tags($row['id']) ?></h1>


<table width="100%" border="2" cellspacing="5" cellpadding="15" style="background: #1c1c22; color: #b2b2b5; padding: 10px;" class="mt-4 fs-5">
<tr class="text-center">
<td class="w-50 text-center">Nom</td>
<td><?= strip_tags($row['lastname']) ?></td>
</tr>
<tr class="text-center">
<td>Prénom</td>
<td><?= strip_tags($row['firstname']) ?></td>
</tr>
<tr class="text-center">
<td>Date de naissance</td>
<td><?= strip_tags($row['birthdate']) ?></td>
</tr>
<tr class="text-center">
<td>Email</td>
<td><?= strip_tags($row['email']) ?></td>
</tr>
<tr class="text-center">
<td>Nationalité</td>
<td><?= strip_tags($row['nationality']) ?></td>
</tr>
<tr class="text-center">
<td>Nom de code</td>
<td><?= strip_tags($row['codeName']) ?></td>
</tr>

<tr class="text-center">
<td>Type</td>
<td id="userType" value="<?= $userType ?>"><?= strip_tags($row['userType']) ?></td>
</tr>
<?php
if($userType == 'agent'): 
  ?>
<tr class="text-center" id="agent_specialities" ">
<td>Specialitiés</td>
  <?php
 while ($row = $query1->fetch(PDO::FETCH_ASSOC)) :
 $specialities = unserialize($row["user_specialities"]);
 ?>
 <td class="text-center px-4 py-2">
   <?php
 foreach($specialities as $speciality) :
   echo  $speciality."<br/>";
   endforeach;
   ?>
   </td>
   <?php
   endwhile;
   ?>        
            
</tr>
<?php
endif;
?>


</table>
</div>
</div>
<!-- <script>
  $(document).ready(function() {
    alert($("userType"));
    var agent_specialities = $("#agent_specialities");
    if( $("userType").val() == "agent" ) {
       
      agent_specialities.removeClass("hidden");
      agent_specialities.addClass("visible");
    }
    agent_specialities.addClass("hidden");
    
  });
  </script> -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<div style="position: fixed; bottom: 0; left: 50%; transform: translateX(-50%);">
<?php 
include_once "../../includes/footer.php"; 
?> 
</div>