<?php
 $missions=true;
require_once "includes/DB.php";
include_once "includes/header.php";
include_once "includes/navbar.php";
$titre = "Missions";
$count = 0;
?>
<link rel="stylesheet" href="style/style_in_ad.css">
<link rel="stylesheet" href="style/style.css">
<style>
  .body_admin{
    background-color: #b2b2b5;
  }
  .col_wh{
    color: white;
  }

</style>
</head>
<div class="p-3 body_page_new " style="height: 90vh;">
<div>
<h1 class="col_wh">Liste de missions</h1>



<?php include_once "missions_content.php"; ?>

<?php include_once "includes/footer.php"; ?>