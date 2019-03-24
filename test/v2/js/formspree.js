$(function($) {
    $('#contactform').submit(function(event) {
		event.preventDefault();
        $.ajax({
			url: 'https://formspree.io/txcdxevubase@mail.ru',
			method: 'POST',
			data: {message: 'hello!'},
			datatype: 'json'
		}).done(function(){
			alert("Email was sent");
		}).fail(function() {
			alert("Error!");
		});
	});
});
  
