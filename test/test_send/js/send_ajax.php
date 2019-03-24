$(function($) {
    $('#contactform').submit(function(event) {
		event.preventDefault();
        $.ajax({
			url: 'https://discover-pangea.000webhostapp.com/send.php',
			method: 'POST',
			data: $(this).serialize()
		}).done(function(){
			alert("Email was sent");
		}).fail(function() {
			alert("Error!");
		});
	});
});
  
