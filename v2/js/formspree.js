$(document).ready(function() {
    $('#contactform').submit(function(e) {
        $.ajax({
	    method: 'POST',
	    url: '//formspree.io/txcdxevubase@mail.ru',
	    data: $('#contactform').serialize(),
	    datatype: 'json'
	});
	e.preventDefault();
	$(this).get(0).reset();
	$('.submit-success').fadeToggle(400);
    });
  
    $('.submit-fail, .submit-success').click(function() {
        $(this).hide();
    })
});
  
