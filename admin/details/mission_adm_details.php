<?php
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
 
<?php include_once "../../missions_details_content.php"; ?>

<?php include_once "../includes/admin_footer.php"; ?>