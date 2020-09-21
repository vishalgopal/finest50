// $('.sidebar-open-btn').click(function(){
// 	$('.sidenav').css ('width','220px');
// 	$('.closebtn').css ('display','block');
// })
// $('.closebtn').click(function(){
// 	$('.sidenav').css ('width','0px');
// 	$('.closebtn').css ('display','none');
// })

// header home
	$(document).on("scroll", function(){
		if
      ($(document).scrollTop() > 100){
		  $(".top-bar").addClass("shrink");
		}
		else
		{
			$(".top-bar").removeClass("shrink");
		}
	});

// header inner
	$(document).on("scroll", function(){
		if
      ($(document).scrollTop() > 45){
		  $(".inner-header2").addClass("sticky-header");
		  $('.black-logo').css ('display', 'none');
		  $('.white-logo').css ('display', 'block');
		}
		else
		{
			$(".inner-header2").removeClass("sticky-header");
			$('.black-logo').css ('display', 'block');
		  $('.white-logo').css ('display', 'none');
		}
	});

	$('.select2-single').select2();

	$('.search-btn-inner').click(function(){
		$('.mini-search').toggle();
	});