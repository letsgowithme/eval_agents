<?php
$missions_admin = true;
require_once "../../includes/DB.php";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
$titre = "Missions";
$count = 0;
?>
<link rel="stylesheet" href="../../style/style_in_ad.css">
<link rel="stylesheet" href="../../style/style.css">
<style>
  .body_admin{
    background-color: #b2b2b5;
  }
  .col_wh{
    color: white;
  }

</style>
</head>
<div class="p-3 body_admin">
  <div>
    <h1 class="title_adm col_wh">Liste de missions</h1>
    <a href="../new/mission_new.php" class="btn btn-primary my-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
      </svg>
    </a>
    <?php include_once "../../missions_content.php"; ?>
    <?php include_once "../includes/admin_footer.php"; ?>