<?php
  require_once "../../includes/DB.php";

$up_id = $_GET["id"];
var_dump($_GET["id"]);
if(isset($_POST["submit"])){ 
  if($_POST["specialities"]){
    $specialitiesArr = [];
    for($i =0; $i < count($_POST['specialities']);$i++){
      $speciality = $_POST['specialities'][$i];
      $specialitiesArr[] = $speciality;
    }
    $specialities = implode(",", $specialitiesArr);
   }
    $lastname = strip_tags($_POST["lastname"]);
    $firstname = strip_tags($_POST["firstname"]);
    $birthdate = strip_tags($_POST["birthdate"]);
    $email = strip_tags($_POST["email"]);
    $nationality = strip_tags($_POST["nationality"]);
    $codeName = strip_tags($_POST["codeName"]);
    $userType = strip_tags($_POST["userType"]);
    
    $sql = "DELETE FROM `user` WHERE id='$up_id'";

    $query = $dbConnect->query($sql); 
    $Execute = $query->execute();
    if($Execute){
    echo '<script>window.open("../lists/usersAll.php?id=Utilisateur a été supprimé", "_self")</script>';
    header("Location: ../lists/usersAll.php");
    echo '<h3>Utilisateur a été supprimé</h3>';
    }
}

$titre = "Inscription";
include_once "../includes/admin_header.php";
// include_once "../../includes/admin_navbar.php";
?>
  <link href="../../style/style.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../logo.png">
  <style>
input{
  font-weight: 500;
}
    </style>
</head>
<body class="body_home body_page">

  <?php 
global $dbConnect;
// require_once "../../includes/DB.php";
$sql = "SELECT * FROM `user` WHERE `id` = '$up_id'";
$query = $dbConnect->query($sql);

while($row = $query->fetch()){
  $id = $row["id"];
  $lastname = $row["lastname"];
  $firstname = $row["firstname"];
  $birthdate = $row["birthdate"];
  $email = $row["email"];
  $user_nationality = $row["nationality"];
  $codeName = $row["codeName"];
  $user_userType = $row["userType"];
  $user_specialities = $row["specialities"];
}
  ?>
<div class="container">
<div class="d-flex justify-content-between mt-3">
<h1>Supprimer l'Utilisateur</h1><div class="message"></div>    
<button class="btn border" style="background: lightgray;"><a 
class="fs-4" style="font-weight: bold; color:darkblue; text-decoration: none;" 
aria-current="page" href="../admin_index.php" id="up">Admin</a></button>
</div>
 
<form method="post" action="user_delete.php?id=<?php echo $up_id; ?>">
<div class="mb-3">
<label for="lastname" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom</label>
    <input type="text" disabled name="lastname" id="lastname" value="<?php echo $lastname ?>">
   </div>
   <div class="mb-3">
    <label for="firstname" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Prénom</label>
    <input type="text" disabled name="firstname" id="firstname" value="<?php echo $firstname ?>">
   </div>
   <div class="mb-3">
    <label for="birthdate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de naissance</label>
    <input type="date" disabled name="birthdate" id="birthdate" placeholder="YYYY-MM-DD" value="<?php echo $birthdate ?>">
   </div>
   <div class="mb-3">
    <label for="email" class="form-label fw-bold my-2 fs-5" style="color: #01013d;" autocomplete="on">Email</label>
    <input type="email" disabled name="email" id="email" value="<?php echo $email ?>">
   </div>
   <!-- ******************Nationalité****************** -->
   <div class="mb-3">
   <label for="nationality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nationalité</label> 
  <input type="text" disabled name="nationality" id="nationality" placeholder="YYYY-MM-DD" value="<?php echo $user_nationality ?>">
    </div>
  
   <!-- ******************Codename****************** -->
   <div class="mb-3">
    <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
    <input type="text" disabled name="codeName" id="codeName" value="<?php echo $codeName ?>">
   </div>
<!-- ******************UserType de user****************** -->
<div class="mb-3">
<label for="userType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type: </label>
<input type="text" name="userType" disabled id="userType" value="<?php echo $user_userType ?>">

 </div>
 <!-- **************Specialities***************** -->
 <div class="mb-3">
   <?php
   if($user_specialities){
    ?>
    <div class="mb-3 mt-3 d-flex" id="agent_speciality">
    <h5 class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d;" id="speciality_title">Spécialité</h5>
    <!-- afficher les specialités de l'Utilisateur -->
   <div class="d-flex flex-column bg-light"> 
   </div>

</div>
<div class="bg-light w-25">
    <?php
    $user_specialities = explode(",", $user_specialities); 
    for($i = 0; $i < count($user_specialities); $i++)
  echo '<option value="' . $user_specialities[$i] . '" class="user_specialities">' . $user_specialities[$i] . '</option>';
   }
?>
  </div>
 

   <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Supprimer</button>
</form>

</div>

<script>
function myFunction() {
  var specialities_list = document.getElementById("specialities_list");
  if (specialities_list.style.display === "none") {
    specialities_list.style.display = "block";
  } else if(specialities_list.style.display === "block") { 
    specialities_list.style.display = "none";
  }
}
</script>
<script>
    let change_userType = document.getElementById("change_userType");
    let userTypeList = document.getElementById("userTypeList");
    let user_userType = document.getElementById("user_userType");
    change_userType.addEventListener("click", function() {
      userTypeList.style.display = "block";
    });
    let userType = document.getElementById("userType");
     
    function toggleList(){
      var specialities_list = document.getElementById("specialities_list");
        if(specialities_list.style.display = "none"){
          specialities_list.style.display = "block";
        }else{
          specialities_list.style.display = "none";
        }
   }
  
    let agent = document.getElementById("agent");
    let list = document.getElementById("specialities_list");
    let speciality_title = document.getElementById("speciality_title");
    let agent_speciality = document.getElementById("agent_speciality");
    let target = document.getElementById("cible");
    let contact = document.getElementById("contact");
   
    agent.addEventListener("click", function () {
      agent_speciality.style.display = "block";
      speciality_title.style.display = "block";
      list.style.display = "block";
    });

    target.addEventListener("click", function () {
      speciality_title.style.display = "none";
      agent_speciality.style.display = "none";
      list.style.display = "none";
    });
    contact.addEventListener("click", function () {
      speciality_title.style.display = "none";
      agent_speciality.style.display = "none";
      list.style.display = "none";
    });
  </script>
<?php
include_once "../includes/admin_footer.php";
?>
