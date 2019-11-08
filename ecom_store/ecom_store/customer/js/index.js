$(document).ready(function(){
	$('a[href^="https://"],[href^="http://"]').not('a[href*=details]').attr('target','_blank');
  });