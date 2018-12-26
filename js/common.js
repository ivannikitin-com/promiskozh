$(document).ready(function() {

	$('.noLink').click(function(){return false;})

	$(".sandwich, #topMenuCont a,.sandLink").click(function() {
		$.magnificPopup.close();
	  if($('.sandwich').hasClass('active')){
	  	$('#topMenuCont').slideUp('slow');
	  }else{
	  	$('#topMenuCont').slideDown('slow');
	  }
	  $(".sandwich").toggleClass("active");
	});
	$('.showCatMenu').click(function(){
		if($('.catMenu').hasClass('active')){
		  	$('.catMenu').slideUp('slow');
		  	$(this).html($(this).attr('data-passive'));
		}else{
		  	$('.catMenu').slideDown('slow');
		  	$(this).html($(this).attr('data-active'));
		}
		$(".catMenu").toggleClass("active");
		return false;
	});


	$("input[name='f_Phone']").mask("+7 (999) 999-99-99");

	$('.modal').magnificPopup({
		showCloseBtn:	false,
		removalDelay: 100, 
		mainClass: 'mfp-zoom-in'
	});

	$('.form').submit(function(e) {	
		form = $(this);
		flag = true;
		form.find('.f_required').is(function(){
				name = form.find('.f_required').val();
				nameC = form.find('.f_required');
				if(nameC.hasClass('error')){nameC.removeClass('error');}
					if(nameC.hasClass('error')){nameC.removeClass('error');}
					if((name=='Ваше имя')|| (name=='')){
						flag = false;
						nameC.addClass('error');
					}
				
		});

		form.find('.f_Phone').is(function(){
			phone = form.find('.f_Phone').val();
			phoneC = form.find('.f_Phone');
			if(phoneC.hasClass('error')){phoneC.removeClass('error');}
			var phoneReg = /^[+() 0-9 ]{7,}$/;
			if(phone == ''){
				flag = false;
				phoneC.addClass('error');
			}
		});
		var emailReg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		form.find('.f_Email').is(function(){
			email = form.find('.f_Email').val();
			emailC = form.find('.f_Email');
			if(emailC.hasClass('error')){emailC.removeClass('error');}
			if(!emailReg.test(email)){
				flag = false;
				emailC.addClass('error');
			}
		});
		if(flag){
			$.ajax({
				type:	"POST",
				url:	form.attr('action'),//"./wp-content/themes/promiskozh/sendok.php",
				data:	form.serialize()
			}).done(function(){
				$.magnificPopup.open({
					items: {src: '#modalOk'},
					mainClass: 'mfp-zoom-in',
					removalDelay: 100, 
				}, 0);

			});
		}
		
		return false;
	});
});