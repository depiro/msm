// ACORDEON
$(document).ready(function () {
	$('.accordionButton').click(function () {
		$('.accordionButton').removeClass('on');
		$('.accordionContent,.accordionContent2').slideUp('normal');
		if ($(this).next().is(':hidden')) {
			$(this).addClass('on');
			$(this).next().slideDown('normal');
		}
	});


	$('.accordionButton').mouseover(function () {
		$(this).addClass('over');
	}).mouseout(function () {
		$(this).removeClass('over');
	});


	$('.accordionContent').hide();

	$('.accordionButton2').click(function () {
		$('.accordionButton2').removeClass('on');
		$('.accordionContent2').slideUp('normal');
		if ($(this).next().is(':hidden')) {
			$(this).addClass('on');
			$(this).next().slideDown('normal');
		}
	});
	$('.accordionButton2').mouseover(function () {
		$(this).addClass('over');
	}).mouseout(function () {
		$(this).removeClass('over');
	});
	$('.accordionContent2').hide();


	$('.accordionButton3').click(function () {
		$('.accordionButton3').removeClass('on');
		$('.accordionContent3').slideUp('normal');
		if ($(this).next().is(':hidden')) {
			$(this).addClass('on');
			$(this).next().slideDown('normal');
		}
	});
	$('.accordionButton3').mouseover(function () {
		$(this).addClass('over');
	}).mouseout(function () {
		$(this).removeClass('over');
	});
	$('.accordionContent3').hide();

	$('.accordionButton4').click(function () {
		$('.accordionButton4').removeClass('on');
		$('.accordionContent4').slideUp('normal');
		if ($(this).next().is(':hidden')) {
			$(this).addClass('on');
			$(this).next().slideDown('normal');
		}
	});
	$('.accordionButton4').mouseover(function () {
		$(this).addClass('over');
	}).mouseout(function () {
		$(this).removeClass('over');
	});
	$('.accordionContent4').hide();
});
// ACORDEON