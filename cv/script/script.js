$(function(){
	$(".navbar a, footer a").on("click", function(event){
		event.preventDefault();
		var hash = this.hash;
		$ ("body").animate({scrolltop : $(hash).offset().top}, 889 ,function(){
			window.location.hash = hash;})
	});
		$('#contact-form').submit(function(e){
		e.preventDefault();
		$('.comment').empty();
		var postdata=$('#contact-form').serialize();
		$.ajax({
			type: 'POST',
			url: 'php/contact.php',
			data: postdata,
			dataType: 'json',
			success: function(resultat){
				if(resultat.issucces)
					{
						$("#contact-form").append("<p class='bien'>votre message a ete bien envoyer,merci de m'avoir contactez :) </p>");
						$("#contact-form")[0].reset();
					}
				else
				{
					$("#prenom + .comment").html(resultat.prenomerror);
					$("#nom + .comment").html(resultat.nomerror);
					$("#message + .comment").html(resultat.messageerror);
					$("#email + .comment").html(resultat.emailerror);
					$("#phone + .comment").html(resultat.phoneerror);
					
				}
			}
		});
	});
})
