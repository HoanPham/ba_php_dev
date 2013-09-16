$(document).ready(function(){
	$('textarea.choice').focusin(function(){
		var array = $(this).attr('id').split("_");
	    var order = array[0].substr(6,1);
	    if(parseInt(order)>3){
	    	if($("#choice"+order+"_"+array[1]+"_width").length==0){
	    		$('#preview_choices_'+array[1]).append("<div id=\"choice"+order+"_"+array[1]+"_width\"></div>");
	    	}
	    }		
	}); 
	$('textarea.choice').keyup(function(){  		
	    var array = $(this).attr('id').split("_");
	    var order = array[0].substr(6,1);	    
	    if($(this).val.length > 0){
	    	if(array[1]=="0101") $("#choice"+order+"_"+array[1]+"_width").html(String.fromCharCode(65 + (order-1))+". "+$(this).val());
	    	else $("#choice"+order+"_"+array[1]+"_width").html(order+". "+$(this).val());
	    }
	    else if($(this).val.length == 0) $("#choice"+order+"_"+array[1]+"_width").html(" ");
	    $(".choice").bind("idle.idleTimer", function(){
	    	MathJax.Hub.Queue(["Typeset",MathJax.Hub,"preview_area"]);
	    });
	});	
	$('.btn.quick_preview').click(function(){
		if($(this).hasClass('off')){			
			$(".no_ku").css({"display":"none"});
			$(".no_skill").css({"display":"none"});
			$(".date_create").css({"display":"none"});
			$(".date_edit").css({"display":"none"});
			$(".edit").css({"display":"none"});
			$(".show_modal_preview").css({"display":"none"});
			$(".delete").css({"display":"none"});
			$("#list_questions").css({"width":"51%","float":"left"});
			$("#quick_preview_block").css({"display":"block","width":"41%","right":"0","position":"fixed"});
		}
		else{
			$("#quick_preview_block").css({"display":"none"});
			$("#list_questions").load("../teacher/question/load_data_manage_question");
			$("#list_questions").css({"width":"100%"});								
		}
	});	
});
function show_modal(question_id,question_type_id){
	var array = {};
	array['question_id'] = question_id;
	array['question_type_id'] = question_type_id;
	array['preview_type'] = "modal";
	$("#modal_preview").load("../teacher/question/load_data_preview_question",array);
	$("#modal_preview").modal('show');
}
function show_quick_preview(question_id,question_type_id){
	var array = {};
	array['question_id'] = question_id;
	array['question_type_id'] = question_type_id;
	array['preview_type'] = "quick";
	//alert(question_id)
	$("#quick_preview_block").load("../teacher/question/load_data_preview_question",array);
}