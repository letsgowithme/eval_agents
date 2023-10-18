<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $titre ?></title>
  <link rel="stylesheet" href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css"> 

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
  <link rel="icon" href="..././logo.png">
  <link href="style/style.css" rel="stylesheet" type="text/css">

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->

 <script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
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
 
