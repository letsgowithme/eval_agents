<?php 
//on demarre la session php
session_start();
if(!isset($_SESSION["user"])){
header("Location: connection.php");
}
//Supprimer var
unset($_SESSION["user"]);
header("Location: index.php");
echo "Page de deconnexion";