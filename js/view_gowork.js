$(document).ready(function(){
  $(".icon_link").hover(function(evt){
  	evt.stopImmediatePropagation();
    $(this).children("span").stop().fadeIn();
  },
  function(){
    $(this).children("span").stop().fadeOut();
  });

  $(".search_form").validate({
  	rules: {
  		search:{
  			minlength:2
  		}
  	}
  });
  $("#all_orders").click(function(){
  if ($( "#all_orders" ).prop( "checked" )){
  	$(".selected_orders").prop('checked', true);
  }
  else{
  	$(".selected_orders").prop('checked', false);
  }
});

  var search_field=$(location).attr('href');
  if (search_field.indexOf("search")!=-1) {
    var search_location=search_field.indexOf("search")+7;
    $("#search").val(search_field.slice(search_location));
  }


  /* $('th').click(function(){
      var icon=$(this).find('i');
      if ($(icon).hasClass('fas fa-arrow-circle-down')) {
      $(icon).removeClass('fas fa-arrow-circle-down').addClass('fas fa-arrow-circle-up');
    }
    else{
      $(icon).removeClass('fas fa-arrow-circle-up').addClass('fas fa-arrow-circle-down');
    }
  });*/
  $.fn.dataTable.moment( 'D-M-YYYY' );
$('table').DataTable({
  paging: false,
  searching: false,
  info:false,
  "columnDefs": [
    { "orderable": false, "targets": [0, -1] }
  ],
  "order": [ [ 2, 'asc' ]],
  "language": {
      "emptyTable": 'Ingen ordre blev fundet!'
    }
});

  $('body').on('click', '.showMore', function(){
    $(this).toggleClass('minus');
    $(this).find('.hidden').toggle();
});
  $('body').on('change', '#amount_per_page', function(){
    var amount= $(this).val();
    var search_field = $('#search').val();
    var urlString='view_bestillinger_gowork.php?amount='+ amount;
    if (search_field!='') {
      urlString+='&search='+search_field;
    }
    window.open(urlString,'_self');
});
  
});