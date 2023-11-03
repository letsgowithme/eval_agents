<script>
    $(document).ready(function(){
      $("#countryList").on("change", function(){
             var countryList = $("#countryList").val();
             var hideout = $("#hideout").val();
             if(countryList){
                  $.ajax({
                    type: "POST",
                    url: "ajaxData.php",
                    data: 'countryList='+countryList,
                    success:function(response){
                   alert($response);
                  // $("#hideout").html(response);
                  }
                  })
             }else{
              $("#hideout").html("<option value=''>Pas de planques dans ce pays></option>");
             }
      });     
      // ***************************************
      $("#countryList").on("change", function(){
             var countryList = $("#countryList").val();
             var contacts = $("#contacts").val();
             if(countryList){
                  $.ajax({
                    type: "POST",
                    url: "ajaxData2.php",
                    data: 'countryList='+countryList,
                    success:function(response){
                   
                  $("#contacts").html(response);
                  }
                  })
             }else{
              $("#contacts").html("<option value=''>Pas de contacts dans ce pays></option>");
             }
      });   
       
  
      //  *********************************************
      $("#targets").on("change", function(){
             var agents = $("#agents").val();
             var targets = $("#targets").val();
             if(targets){
                  $.ajax({
                    type: "POST",
                    url: "ajaxData2.php",
                    data: 'targets='+targets,
                    success:function(response){
                  //  alert(response);
                  $("#agents").html(response);
                  }
                  })
             }else{
              $("#agents").html("<option value=''>Pas d'agents requis></option>");
             }
      });  
    // ****************************************************
    $("#description").on("click", function(){
             var title = $("#title").val();
             if(title){
                  $.ajax({
                    type: "POST",
                    url: "ajaxData3.php",
                    data: 'title='+title,
                    success:function(response){
                  //  alert(response);
                  $("#title").html(response);
                  }
                  })
             }
      });   
     
          //  $("#speciality").on("click", function(){
          //     alert( $("#agents").val());
          //  });
       
                // afficher les agents avec specialité choisie
            $("#speciality").on("change", function(){
             var speciality = $("#speciality").val();
             var agents = $("#agents").val();
             if(speciality){
                  $.ajax({
                    type: "POST",
                    url: "ajaxData2.php",
                    data: 'speciality='+speciality,
                    success:function(response){
                  //  alert(response);
                  $("#agents").html(response);
                  }
                  })
             }else{
              $("#agents").html("<option value=''>Pas d'agents avec la spécialité requise></option>");
             }
      });   

    }); 
           </script>