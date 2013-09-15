$(document).ready(function(){	
	$('#create_question_slide').click(function() {
		$("#create_question").css({
		      "position": "relative"
		});
		$("#manage_questions").css({
		      "position": "absolute"
		});
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
		$("#manage_questions").css({
		      "position": "relative"
		});		
	    $("#create_question").animate({
	         left: '-75%'
	     }, 500);	    
	     if ($("#create_question").next().length > 0) {
	         $("#create_question").next().animate({
	             left: '50%'
	         }, 500);
	         $("#create_question").css({
			      "position": "absolute"
			});
	     } else {
	         $("#create_question").prevAll().last().animate({
	             left: '50%'
	         }, 500);
	         $("#create_question").css({
			      "position": "absolute"
			});
	     }	     
	});		
});
function edit(id_question,question_type_id){
	var array = {};
    array['question_id'] = id_question;
    array['question_type_id'] = question_type_id;
	$('#create_id_question').load("../teacher/question/load_data_edit_question",array);
	$("#create_question").css({
	      "position": "relative"
	});
	$("#manage_questions").css({
	      "position": "absolute"
	});
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
}