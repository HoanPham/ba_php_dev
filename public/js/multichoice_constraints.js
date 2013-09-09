function disable_checkbox(class_name,id){	
	$("."+class_name).each(function () {
		if($(this).attr('id').trim()!=id && !$(this).closest('div').hasClass('off')){
			$(this).attr("checked", false);
			$(this).closest('div').addClass('off');
			return false;
		} 
	});
}
function enable_no_right_checkbox(class_name,id){
	var i=0;
	$("."+class_name).each(function () {
		if(!$(this).closest('div').hasClass('off') && $(this).attr('id').trim()!=id) i++;		
	});
	if(i==0){
		var array = class_name.split("_");
		$(".no_right_answer_toggle_"+array[2]).removeClass('off');
		$(".no_right_answer_toggle_"+array[2]).removeAttr('data-toggle');
		$(".button_show_right_answer_"+array[2]).removeClass('disabled');
		$(".button_show_right_answer_"+array[2]).removeClass('off');
		$(".button_show_right_answer_"+array[2]).attr('data-toggle','toggle');
		$(".right_answer_input_"+array[2]).css({"display":"block"});
	}	
}
$(document).ready(function(){
	$('.toggle.btn.multichoice_radio').click(function(){		
		var checkbox = $(this).find('input');	
		if($(this).hasClass('off')){
			$(this).attr('data-toggle','toggle');
			disable_checkbox(checkbox.attr('class'),checkbox.attr('id'));
		}
		else if(!$(this).hasClass('off')){
			$(this).removeAttr('data-toggle');
		}
	});
	$('.toggle.btn.no_right_answer').bind("click",function(){
		var checkbox = $(this).find('input');
		if(!$(this).hasClass('off')){
			enable_no_right_checkbox(checkbox.attr('class'),checkbox.attr('id'));
		}
		else if($(this).hasClass('off')){
			var array = checkbox.attr('id').split("_");
			$(".no_right_answer_toggle_"+array[2]).attr('data-toggle','toggle');
			$(".no_right_answer_toggle_"+array[2]).addClass('off');
			$(".button_show_right_answer_"+array[2]).addClass('disabled off');
			$(".button_show_right_answer_"+array[2]).removeAttr('data-toggle');
			$(".right_answer_input_"+array[2]).css({"display":"none"});
		}
	});
	/*
	$(".button_show_right_answer").click(function(){
		var checkbox = $(this).find('input');
		var array = checkbox.attr('id').split("_");
		if(!$(this).hasClass("off")){			
			$(".right_answer_input_"+array[2]).css({"display":"none"});
		}
		else if($(this).hasClass("off") && !$(this).hasClass("disabled")){
			$(".right_answer_input_"+array[2]).css({"display":"block"});
		}
	});
	*/
	$(".no_right_answer_toggle").click(function(){
		var checkbox = $(this).find('input');
		var array = checkbox.attr('id').split("_");
		if($(this).hasClass("off")){
			$('.toggle.btn.no_right_answer').addClass("off");
			$(".button_show_right_answer_"+array[2]).removeClass('disabled');
			$(".button_show_right_answer_"+array[2]).removeClass('off');
			$(".button_show_right_answer_"+array[2]).attr('data-toggle','toggle');
			$(".right_answer_input_"+array[2]).css({"display":"block"});
		}
		else if(!$(this).hasClass("off")) $(this).removeAttr('data-toggle');
	});
});