<?php 
//on demarre la session php

//on traite le formulaire
if(!empty($_POST)){
  if(isset($_POST["title"]) &&!empty($_POST["title"])){
$title = strip_tags($_POST["title"]);

require_once "../../includes/DB.php";

$sql = "INSERT INTO `missionType`(`title`) 
VALUES(:title)";

$query = $dbConnect->prepare($sql);

$query->bindValue(':title', $title, PDO::PARAM_STR);

if(!$query->execute()){
  die("Failed to insert INTO `missionType`");
} 
$id = $dbConnect->lastInsertId();

// header("Location: mission_type_new.php");
echo "<p>Type de mission ajouté sous le numéro ". $id."</p>";
echo "<a href='missionType_new.php'>Retour</a>";
exit;


  }else{
    die("Le formulaire est incomplet");
  }
}
$titre = "Add mission type";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";

?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">

<style>
  input {
    font-size: 1.3em;
    margin-bottom: 10px;
  }

  label {
    width: 250px;

    color: #b2b2b5;
    padding: 5px;
  }
</style>
<script>
    $(document).ready(function(){
      $("#btn_submit").on("click", function(){
             var title = $("#title").val();
             if(title){
                  $.ajax({
                    type: "POST",
                    url: "ajaxData2.php",
                    data: 'title='+title,
                    success:function(response){
                  //  alert(response);
                  $("#title").html(response);
                  }
                  })
            
              
             }
      });     
    });    
    </script>
</head>
<body class="body_page_new">
  <div class="container">
   <div class="d-flex justify-content-between mt-4">
<h1>Ajouter un type de mission</h1>    
<button class="btn border" style="background: lightgray;"><a class="fs-4" style="font-weight: bold; color:darkblue; text-decoration: none;" aria-current="page" href="../admin_index.php" id="up">Tableau de bord</a></button>
</div>
<form class="form" action="missionType_new.php" method="post">
  <div class="mb-3">
    <label for="title" class="form-label fw-bold my-4 fs-2" style="color: #01013d;">Type de mission</label>
    <input type="text" class="form-control w-50" name="title" value="">
    <?php
include_once "btn_create.php";
?>
</form>

</div>

</div>
<?php
include_once "../includes/admin_footer.php";
?>
