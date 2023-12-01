<?php
 $missions=true;
 $titre = "Missions";
require_once "includes/DB.php";
include_once "includes/header.php";
include_once "includes/navbar.php";

$count = 0;
?>
<link rel="stylesheet" href="style/style_in_ad.css">
<link rel="stylesheet" href="style/style.css">

</head>
<div class="p-3 body_page_new " style="height: 100vh;">
<div>
<h1 class="col_wh">Liste de missions</h1>



<?php include_once "missions_content.php"; ?>

<div class="text-center btn_line mb-1">
<button type="button" class="btn btn-primary"><a href="#up" class="text-light text-decoration-none">Vers le haut</a></button>
</div>
<div class="text-center btn_line mb-1">
<button type="button" class="btn btn-primary"><a href="index.php" class="text-light text-decoration-none">Accueil</a></button>
</div>

<?php include_once "includes/footer.php"; ?>