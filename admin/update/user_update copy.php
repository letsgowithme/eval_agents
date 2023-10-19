<?php
  require_once "../../includes/DB.php";

$up_id = $_GET["id"];
// if (!isset($_GET["id"]) || empty($_GET["id"])){
//   header("Location: user_update.php");
//   exit;
// }
if(!empty($_GET["id"])){
  global $dbConnect;
  // require_once "../../includes/DB.php";
  $sql = "SELECT * FROM `user` WHERE `id` = '$up_id'";
  $query = $dbConnect->query($sql);
  while($row = $query->fetch()):
  // if(!empty($_GET["specialities"])){
   
  //   $specialitiesArr = [];
  //   for($i =0; $i < count($_POST['specialities']); $i++){
  //     $user_speciality = $_POST['specialities'][$i];
  //     $specialitiesArr[] = $user_speciality;
  //   }   
  //   $specialities = implode(",", $specialitiesArr);
   
  // }else{
  //   $specialitiesArr = [];
  //   $specialities = implode(",", $specialitiesArr);
  // }


    // $lastname = strip_tags($_POST["lastname"]);
    // $firstname = strip_tags($_POST["firstname"]);
    // $birthdate = strip_tags($_POST["birthdate"]);
    // $email = strip_tags($_POST["email"]);
    // $nationality = strip_tags($_POST["nationality"]);
    // $codeName = strip_tags($_POST["codeName"]);
    // $userType = strip_tags($_POST["userType"]);
    


    // $sql = "UPDATE `user` SET lastname='$lastname', firstname='$firstname', birthdate='$birthdate', email='$email',  nationality='$nationality', codeName='$codeName', userType='$userType',  specialities='$specialities'  WHERE id='$up_id'";

    // $query = $dbConnect->query($sql); 
    // $Execute = $query->execute();
    // if($Execute){
    //   echo "<p style=\"background: lightblue;\" class=\"text-center p-2\">Utilisateur modifié sous le numéro ". $up_id."</p>";
    //   echo "<p style=\"background: lightblue;\" class=\"text-center p-2\">Retour à la page de création dans 5 seconds. Sinon appuyez sur le lien : <a href='../lists/usersAll.php'>Retour</a></p>";
    // }
// }

$titre = "Modifier l'utilisateur";
include_once "../includes/admin_header.php";
// include_once "../../includes/admin_navbar.php";
?>
  <link href="../../style/style.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../logo.png">
</head>
<body class="body_home body_page">

  <?php 

while($row = $query->fetch()):
  $id = $row["id"];
  $lastname = $row["lastname"];
  $firstname = $row["firstname"];
  $birthdate = $row["birthdate"];
  $email = $row["email"];
  $user_nationality = $row["nationality"];
  $codeName = $row["codeName"];
  $user_userType = $row["userType"];
  // pour recuperer spec de user
  $specialities = $row["specialities"];


  ?>
<div class="container">
<div class="d-flex justify-content-between mt-3 mb-3 mx-2">
<div><h1>Modifier l'Utilisateur</h1></div> 
<div>
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="../lists/usersAll.php" id="up">Utilisateurs</a></button>
   
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="../admin_index.php" id="up">Tableau de bord</a></button>
</div>
</div>    
<form method="post" action="user_update.php?id=<?php echo $up_id; ?>">
<div class="mb-3">
<label for="lastname" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom</label>
    <input type="text" name="lastname" id="lastname" value="<?php echo $lastname ?>">
   </div>
   <div class="mb-3">
    <label for="firstname" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Prénom</label>
    <input type="text" name="firstname" id="firstname" value="<?php echo $firstname ?>">
   </div>
   <div class="mb-3">
    <label for="birthdate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de naissance</label>
    <input type="date" name="birthdate" id="birthdate" placeholder="YYYY-MM-DD" value="<?php echo $birthdate ?>">
   </div>
   <div class="mb-3">
    <label for="email" class="form-label fw-bold my-2 fs-5" style="color: #01013d;" autocomplete="on">Email</label>
    <input type="email" name="email" id="email" value="<?php echo $email ?>">
   </div>
   <!-- ******************Nationalité****************** -->
   <div class="mb-3">
   <label for="nationality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nationalité</label> 
  <input type="text" name="nationality" id="nationality" placeholder="YYYY-MM-DD" value="<?php echo $user_nationality ?>">
    </div>
  
   <!-- ******************Codename****************** -->
   <div class="mb-3">
    <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
    <input type="text" name="codeName" id="codeName" value="<?php echo $codeName ?>">
   </div>
<!-- ******************UserType de user****************** -->
<label for="userType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type: </label>
<input type="text" name="userType" id="userType" value="<?php echo $user_userType ?>">
<button type="button" id="change_userType">Changer</button>
<div id="userTypeList" style="display: none;">
<!-- afficher les type de l'Utilisateur -->
<?php 
$userTypeArray = array("agent", "cible", "contact");

foreach ($userTypeArray as $userType) {
  ?>
    <input type="radio" name="userType" value="<?php echo $userType ?>" 
    class="choices" style="margin-left: 10px;" id="<?php echo $userType ?>"><span 
    style="font-size: 1.1em; font-weight: bold; padding-left:2px;"><?php echo $userType ?></span>
  <?php
}
?>
 </div>
 <!-- ********************Specialities*********************** -->
  <div class="mb-3 mt-3 d-flex" id="agent_speciality">
   <h5 class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d;" id="speciality_title">Spécialité</h5>
   <div class="d-flex flex-column bg-light"> 
    <!-- afficher les specialités de l'Utilisateur -->
   <?php
  $specialities = explode(",", $specialities); 
  for($i = 0; $i < count($specialities); $i++){
    echo '<option name="user_specialities[]" value="' . $specialities[$i] . '" class="user_specialities">' . $specialities[$i] . '</option>';
  }

?>
</div>
<div class="d-flex flex-row">
  <div><button onclick="myFunction()" class="mx-2" id="change_speciality" type="button">Changer</button>
</div>
<!-- afficher la liste de specialités -->
</div> 

<div class="specialities_list mb-4" id="specialities_list" style="display: none;">
   <?php include_once('../lists/specialities_chbox.php');
   $specialitiesArray[] = $speciality;
   $specialities = implode(',', $specialitiesArray);

   ?> 
 </div>


</div>
<div id="warning_messages">
<div><span style="color: red; font-weight: bold; font-size: 1.2em;">Attention, les anciennes spécialités seront remplacées par de nouvelles!</span></div>
<div><span style="color: gdarkgray; font-weight: bold; font-size: 1em;">Si vous souhaitez conserver les anciennes spécialités, merci de cocher à nouveau les cases!</span></div>
</div>
   <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Enregistrer</button>
</form>
<div>
  <?php 
  endwhile;

?>
<button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top">
  <a href="../admin_index.php">Admin</a>
</button>
</div>
</div>

<script>
function myFunction() {
  var specialities_list = document.getElementById("specialities_list");
  var change_speciality = document.getElementById("change_speciality");
  var agent_speciality = document.getElementById("agent_speciality");
 
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
      specialities_list.style.display = "none";
      change_speciality.style.display = "none";
      agent_speciality.style.display = "none";
      
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
    let warning_messages = document.getElementById("warning_messages");
    if(userType.value == "cible" || userType.value == "contact"){
      specialities_list.style.display = "none";
      change_speciality.style.display = "none";
      speciality_title.style.display = "none";
      warning_messages.style.display = "none";
    }
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
