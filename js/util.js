$(document).ready(function (){
    $("form").on("submit", function(event) {
        event.preventDefault();

        // var data = $("form").serialize();
        var data = [];
        $('.frm input:checked').each(function() {
          data.push($(this).attr('value'));
        });

        // console.log(data); // DEBUG
        // console.log(data.length); // DEBUG
        
        if (data.length > 0 && data.length<=5){
          $.ajax({
              type: "POST",
              url: "php/retriveData.php",
              data: {"scelti": data},
              dataType: "html",
              success: function(response){                    
                  $("#responsecontainer").html(response);
              }});
        }else{
          if(data.length > 5){
            alert("Puoi selezionare al massimo 5 concorrenti!!!! >:-|");
            $('.frm input:checked').prop('checked', false);
          }else{
            alert("Scegline almeno 1 su..");
            $('.frm input:checked').prop('checked', false);
          }
        }
    });
    
    $("#resetBtn").click(function(){
      $("#responsecontainer").html('');
    })
});
