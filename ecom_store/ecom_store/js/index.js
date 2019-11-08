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
    
    $("#registration_form").validate();

});