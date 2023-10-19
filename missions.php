<?php 
$missions=true;
require_once "includes/DB.php";
session_start();
include_once "includes/header.php";
include_once "includes/navbar.php";

$titre = "Missions";
?>
</head>

<!-- <div class="container w-75" style="height: 85svh;"> -->
<?php include_once "missions_content.php"; ?>