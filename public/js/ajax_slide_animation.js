$(document).ready(function(){	
	$('#create_question_slide').click(function() {
	    	$("#manage_questions").animate({
	         left: '-75%'
	     }, 500);
	 
	     if ($("#manage_questions").next().length > 0) {
	         $("#manage_questions").next().animate({
	             left: '50%'
	         }, 500);
	     } else {
	         $("#manage_questions").prevAll().last().animate({
	             left: '50%'
	         }, 500);
	     }
	});
	$('#manage_question_slide').click(function() {
	    $("#create_question").animate({
	         left: '-75%'
	     }, 500);
	 
	     if ($("#create_question").next().length > 0) {
	         $("#create_question").next().animate({
	             left: '50%'
	         }, 500);
	     } else {
	         $("#create_question").prevAll().last().animate({
	             left: '50%'
	         }, 500);
	     }
	});
});