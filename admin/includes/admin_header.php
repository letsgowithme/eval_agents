<?php 
$admin=true;
session_start(); ?>
<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $titre ?></title>
  <link rel="stylesheet" href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <!-- <link rel="stylesheet" href="../../style/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
  <!-- <link rel="stylesheet" href="../../style/dataTables.min.css"> -->

  <link rel="icon" href="..././logo.png">

  <script src="https://getbootstrap.com//docs/5.3/assets/js/color-modes.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="https://getbootstrap.com//docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="https://getbootstrap.com//docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="https://getbootstrap.com//docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="https://getbootstrap.com//docs/5.3/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="https://getbootstrap.com//docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="https://getbootstrap.com//docs/5.3/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#712cf9">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

 <!-- <script src="../../js/jquery.min.js" type="text/javascript"></script>
<script src="../../js/jquery.dataTables.min.js" type="text/javascript"></script> -->
<script>$(document).ready(function () {
    $.noConflict();
    var table = $('#datatable').DataTable({
      "oLanguage": {
        "sLengthMenu": "Afficher _MENU_ Enregistrements",
        "sSearch": "Rechercher:",
        "sInfo":"Total de _TOTAL_enregistrements (_END_ / _TOTAL_)",
        "oPaginate": {
          "sNext": "Suivant",
          "sPrevious": "Précedent"
        }
      }
    });
});</script>

 <!-- <main>
  <div class="d-flex"> -->