<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <div class="content">
      <h1>Spéciality 1</h1>
    </div>
    <button type="button" id="add_spec2">Ajouter une spécialité</button>
  </div>


  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      // clear session storage
      sessionStorage.clear();
      $("#add_spec2").click(function(e) {

        e.preventDefault();
        // secssion storage
        var count = sessionStorage.getItem("count");
        if (count == null) {
          count = 1;

        }
        $.ajax({
          type: "GET",
          url: "ajax.php",
          data: {
            count
          },
          dataType: "json",
          success: function(response) {
            //update count
            count = response.count;
            // update session storage
            sessionStorage.setItem("count", count);
            //update conent
            $(".content").append(response.content);

          }
        });
      });
    });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#add_spec2").on("click", function() {
        var depart_code = $("#inputdepart").val();
        if (depart_code) {
          $ajax({
            type: 'POST',
            url: 'ajaxData.php',
            data: 'depart_code=' + depart_code,
            success: function(response) {
              $("#inputville").html(response);
            }
          })
        }
      });
    } else {
      $("#inputville").html("<option value=''>Selectionnez d\'abord un departement</option>");
    }
  
    });
  </script>
</body>


</html>