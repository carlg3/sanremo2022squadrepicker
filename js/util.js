ALERT_POST = "\
-- Disclaimer --\n\
Mostra le possibili squadre a seconda dei concorrenti che scegliete. \n\
Potrebbe \"funzionare\" meglio se si scelgono 2 o 3 concorrenti a volta, senn\u00F2" + " \u00E8 probabile che non trova niente.\n\
Ci ho perso poco tempo perch\u00E9 mi sono accorto che non aveva tantissimo senso per\u00F2 un'idea della squadra la d\u00E0 :PPP\
";

$(document).ready(function (){
    alert(ALERT_POST);

    $("form").on("submit", function(event){
        event.preventDefault();

        // var data = $("form").serialize();
        var data = [];
        $('.frm input:checked').each(function(){ data.push($(this).attr('value')); });

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
    
    $("#resetBtn").click(function(){ $("#responsecontainer").html(''); });
});
