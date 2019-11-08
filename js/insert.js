$(document).ready(function(){
  $(".btn").click(function(){

  });

  $("#order_date").datepicker({
    changeYear:true,
    dateFormat: 'dd-mm-yy',
    minDate:'+30d'
  }).on('change', function() {
        $(this).valid();
    });

  if ($("#order_meeting").val()=="Lokale"){
    $(".hidden").show();
  }

  $("#order_meeting").change(function(){
    if ($(this).val()=="Lokale") {
      $(".hidden").slideDown();
    }
    else{
      $(".hidden").slideUp();
    }
  });

  $("#submit").on('click', function(){
    var future=new Date();
    future.setDate(future.getDate() + 29);
    var enteredDate = $( "#order_date" ).datepicker( "getDate" );
    var differenceDate=enteredDate-future;

    if (differenceDate<0) {
      alert('Eksamensdato skal være mindst 30 dage fra dagsdato.');
      return false;
    }

    return confirm('Er du sikker du vil sende ordren af sted?');
  });

  $("#kladde").on('click', function(){
    return confirm('OBS: En kladde bliver ikke sendt til GO:WORK. Derfor hvis ordren bliver gemt som en kladde, har I selv ansvar for at tjekke op på det løbende og sende ordren i god tid. Ved ordre med færre end 30 dage til startdato, skal I kontakte GO:WORK, da det ikke er muligt at sende dem online!');
  });


  $.validator.addMethod("anyDate",
    function(value, element) {
        return value.match(/^(0?[1-9]|[12][0-9]|3[0-1])[/., -](0?[1-9]|1[0-2])[/., -](19|20)?\d{2}$/);
    },
    "Dato skal være dd-mm-yyyy!"
  );

  $("form").validate({
    rules: {
      client_pass:{
        required: true,
        minlength:8
      },
      order_shifts:{
        min:1
      },
      order_date:{
        anyDate: true
      }
    },
    messages: {
      order_form: "Required"
    }
  });

  $("#order_start_time").change(function(){
      var start=parseInt($(this).val().substring(0,2),10);
      var i;
      var time_options="";
      for (i=+start+1; i < 19; i++) { 
      time_options += "<option>" + i + ":00</option>";
      time_options += "<option>" + i + ":15</option>";
      time_options += "<option>" + i + ":30</option>";
      time_options += "<option>" + i + ":45</option>";
    }
      $("#order_stop_time").html(time_options);
      
});

  $(".icon_link").hover(function(){
    $(this).children("span").fadeIn();
  },
  function(){
    $(this).children("span").fadeOut();
  });

$('.confirmation').on('click', function () {
        return confirm('Ændrigerne vil ikke blive gemt!');
    });
   
});