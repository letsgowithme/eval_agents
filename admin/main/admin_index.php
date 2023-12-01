<?php
$admin = true;
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
$titre = "admin";
?>
<link rel="stylesheet" href="../../style/style_in_ad.css">
<link rel="stylesheet" href="../../style/style.css">
<style>
  .body_admin{
    background-color: #404144;
  }
  @media screen and (min-width: 375px) {
    .body_admin{
    min-width: 400px;
    }
h1{
  word-wrap: break-word;
}
  }
</style>
</head>
<div class="p-3 body_admin">

  <h1 class="text-light d-flex admin_title">Page d'administration du site d'agents secrets</h1>
</div>

<?php include "../includes/admin_footer.php"; ?>