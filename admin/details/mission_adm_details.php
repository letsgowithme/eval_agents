h<?php
$missions_admin=true;
require_once "../../includes/DB.php";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
$titre = "Mission details";
$count = 0;
?>
<link rel="stylesheet" href="../../style/style_in_ad.css">
<link rel="stylesheet" href="../../style/style.css">
</head>
<?php if(isset($_SESSION["user"])){
  if($_SESSION["user"]["roles"] < 4 ){

    include_once "../../missions_details_content.php"; 

    include_once "../includes/admin_footer.php";
  }else{
    echo "<h2 class=\"fs-4 text-info\">Access interdut</h2>";
  }
}

  