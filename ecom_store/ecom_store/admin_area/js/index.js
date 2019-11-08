$(document).ready(function() {
    $('#activable').click(function() {
        $(this).addClass('active');
    });

    $('.card-header').click(function(){
    	if ($(this).find('i').hasClass('fa-angle-down')) {
    	$(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
    }
    else{
    	$(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
    }
    });
    $("#filter-manufacturer").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#dev-manufacturer li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
    $("#filter-cats").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#dev-cats li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
    $("#filter-p-cats").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#dev-p-cats li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
    $("#eksamen_dato").datepicker({
        showWeek:true
    });

    $.validator.addMethod("time24", function(value, element) {
    return /^([01]?[0-9]|2[0-3])(:[0-5][0-9])+$/.test(value);
    }, "Tidspunktformat skal være hh:mm.");

    var ruleSet1 = {
        required: true,
        time24: true
    };
    $("#registration_form").validate({
        rules: {
            eksamen_slut: ruleSet1,
            eksamen_start:ruleSet1
        }
    });
});