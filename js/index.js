$(document).ready(function(){
  $(".icon_link").hover(function(){
    $(this).children("span").fadeIn();
  },
  function(){
    $(this).children("span").fadeOut();
  });

});