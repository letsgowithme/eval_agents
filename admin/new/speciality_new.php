<?php
if (!empty($_POST)) {
  if (isset($_POST["title"]) && !empty($_POST["title"])) {
    $title = strip_tags($_POST["title"]);
    require_once "../../includes/DB.php";
    $sql = "INSERT INTO speciality(title) 
VALUES(:title)";
    $query = $dbConnect->prepare($sql);
    $query->bindValue(':title', $title, PDO::PARAM_STR);
    if (!$query->execute()) {
      die("Failed to insert INTO Spécialité");
    }
    $id = $dbConnect->lastInsertId();
    echo "<p style=\"background: darkgrey;\" class=\"text-center text-white p-2\">Spécialité ajoutée sous le numéro " . $id . "</p>";
    echo "<p style=\"background: darkgrey;\" class=\"text-center text-white p-2\">Retour à la page de création dans 5 seconds. Sinon appuyez sur le lien : <a class=\"text-dark text-bold\" href='speciality_new.php'>Retour</a></p>";
?>
    <script>
      function backToPage() {
        window.location.href = "speciality_new.php";
      }
      setTimeout(backToPage, 8000);
    </script>
<?php
  } else {
    die("Le formulaire est incomplet");
  }
}
$titre = "Add speciality";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">
<style>
  input {
    font-size: 1.3em;
    margin-bottom: 10px;
  }

  label {
    width: 220px;

    color: #b2b2b5;
    padding: 5px;
  }
  h1{
    color:white;
  }
</style>
<script>
  $(document).ready(function() {
    $("#btn_submit").on("click", function() {
      var title = $("#title").val();
      if (title) {
        $.ajax({
          type: "POST",
          url: "ajaxData.php",
          data: 'title=' + title,
          success: function(response) {
            //  alert(response);
            $("#title").html(response);
          }
        })
      }
    });
  });
</script>
</head>
<div>
  <div class="mt-4 body_page_new px-4" style="height: 90%;">
    <h1 class="mt-4">Ajouter une spécialité</h1>

    <form class="form" action="speciality_new.php" method="post">
      <div class="mb-3">
        <label for="title" class="form-label fw-bold my-4 fs-2 text-light">Spécialité</label>
        <input type="text" class="form-control w-25" name="title" value="" id="title">
        <?php
        include_once "btn_create.php";
        ?>
    </form>

  </div>
</div>
<div style="position: fixed; bottom: 0;">
  <?php
  include_once "../includes/admin_footer.php";
  ?></div>