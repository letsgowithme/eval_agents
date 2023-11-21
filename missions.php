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
</head>
<div class="p-3 body_page_new " style="height: 90vh;">
<div>
<h1>Liste de missions</h1>



<?php include_once "missions_content.php"; ?>

<?php include_once "includes/footer.php"; ?>