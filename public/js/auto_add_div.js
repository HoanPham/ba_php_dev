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
function add_more_choice(val, id, object, question_type) {
	var question_type_id = question_type;
	question_type = "_"+question_type;	
	var len = $(val).val().length;
	var choices = id + 1;
	var choices_next = id + 2;
	var newFieldset = document.createElement("fieldset");
	switch (object) {
	case 1:
		var object_id = "detailed_answer";
		var form_id = "list_detail_answers";
		newFieldset.setAttribute('id', choices + question_type);
		newFieldset.innerHTML = "<textarea id='"
				+ object_id
				+ choices
				+ question_type
				+ "' class='detailed_answer detailed_answer"
				+ question_type
				+ "' onkeyup='add_more_choice(this,"
				+ choices
				+ ","
				+ object
				+ ",\""
				+ question_type_id
				+ "\")' placeholder='Bước "
				+ choices
				+ "'></textarea>";
		break;
	case 2:
		var object_id = "hint";
		var form_id = "list_hints";
		newFieldset.setAttribute('id', choices + question_type);
		newFieldset.innerHTML = "<textarea id='"
				+ object_id
				+ choices
				+ question_type
				+ "' class='hint hint"
				+ question_type
				+ "' onkeyup='add_more_choice(this,"
				+ choices
				+ ","
				+ object
				+ ",\""
				+ question_type_id
				+ "\")' placeholder='Gợi ý "
				+ choices + "'></textarea>";
		break;
	case 3:		
		var object_id = "choice";
		var form_id = "list_answers";
		newFieldset.setAttribute('id', choices + question_type);
		if (question_type_id === "0104")
			newFieldset.innerHTML = "<label for='"+object_id+choices+question_type+"'>Lựa chọn "
					+ choices
					+ "</label> <textarea onkeyup='add_more_choice(this,"
					+ choices
					+ ","
					+ object
					+ ",\""
					+ question_type_id
					+ "\")' id='"
					+ object_id
					+ choices
					+ question_type
					+ "' class='choice"
					+ question_type
					+" choice'></textarea> <div style='width:40px;' class='no_right_answer toggle btn btn-primary off' data-toggle='toggle'><input question_type='checkbox' id='"+object_id+choices+"_right"+question_type+"'class='choice_right"+question_type+"'><div class='toggle-group'><label class='toggle-on btn btn-primary'>Đúng</label> <label class='toggle-off btn btn-success active'>Sai</label> <span class='toggle-handle btn'></span></div></div> <br> <label for='explain"+choices+question_type+"'>Giải thích</label> <textarea id='explain"+choices+question_type+"' class='explain"+question_type+"' style='margin-left:11px;' placeholder='Giải thích'></textarea>";
		else
			newFieldset.innerHTML = "<label for='"+object_id+choices+question_type+"'>Lựa chọn "
					+ choices
					+ "</label> <textarea onkeyup='add_more_choice(this,"
					+ choices
					+ ","
					+ object
					+ ",\""
					+ question_type_id
					+ "\")' id='"
					+ object_id
					+ choices
					+ question_type
					+ "' class='choice"
					+ question_type
					+ " choice'></textarea> <div style='width:40px;' class='no_right_answer toggle btn btn-primary off' data-toggle='toggle'><input question_type='checkbox' id='"+object_id+choices+"_right"+question_type+"'class='choice_right"+question_type+"'><div class='toggle-group'><label class='toggle-on btn btn-primary'>Đúng</label> <label class='toggle-off btn btn-success active'>Sai</label> <span class='toggle-handle btn'></span></div></div> <br> <div style='display:inline'><label for='explain"+choices+question_type+"'>Giải thích</label> <textarea id='explain"+choices+question_type+"' class='explain"+question_type+"' style='margin-left:11px;' placeholder='Giải thích'></textarea><label for='point1'>Được</label><select id='point"+choices+"' class='span3 point'><option value='0.25'>0.25</option><option value='0.75'>0.75</option><option value='1'>1</option></select><div>";
		break;
	}
	if (len != 0 && document.getElementById(object_id + choices + question_type) == null) {
		var formID = document.getElementById(form_id + question_type);
		formID.appendChild(newFieldset);
		$('textarea').autosize(); 
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
		    $("#choice"+order+"_"+array[1]+"_width").html($(this).val());
		    MathJax.Hub.Queue(["Typeset",MathJax.Hub,"choice"+order+"_"+array[1]+"_width"]);
		});
	}
	if (len == 0
			&& document.getElementById(object_id + choices + question_type)
			&& document.getElementById(object_id + choices + question_type).value == ""
			&& document.getElementById(object_id + choices_next + question_type) == null) {
		var formID = document.getElementById(form_id + question_type);
		formID.removeChild(document.getElementById(choices + question_type));
	}
}