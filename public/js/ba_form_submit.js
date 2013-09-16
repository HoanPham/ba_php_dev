function create_question(type){
	var ajax = new XMLHttpRequest();
	var detailed_answer_array = [];
	var hint_array = [];
	var choice_array = [];
	var choice_right_array = [];
	var explain_array = [];
	var point_array = [];
	var subject = $("#subject").val();
	var grade = $("#grade").val();
	var curriculum = $("#curriculum").val();
	if($("#all_wrong"+type).is(':checked')){
		var no_right_choice = 1;
		var right_answer = $("#right_answer"+type).val();
	}
	else{
		var no_right_choice = 0;
		var right_answer = null;
	}
	if($("#suffle_answer").is(':checked') || !$(this).closest('div').hasClass("off")) var suffle = 1;
	else var suffle = 0;
	$(".detailed_answer_"+type).each(function (i) {	
		if(i==0) var myStr_Detail = $(this).val();
		var myStr_Detail = '"""'+$(this).val();
		detailed_answer_array.push(myStr_Detail);
	});
	$(".hint_"+type).each(function (i) {
		if(i==0) var myStr_Hint = $(this).val();
		else var myStr_Hint = '"""'+$(this).val();
		hint_array.push(myStr_Hint);
	});
	$(".choice_"+type).each(function (i) {
		if(i==0) var myStr_Choice = $(this).val();
		else var myStr_Choice = '"""'+$(this).val();
		choice_array.push(myStr_Choice);
	});
	if(type==="0104"||type==="0105"||type==="0101"){
		$(".choice_right_"+type).each(function () {
			if($(this).is(':checked') || !$(this).closest('div').hasClass("off"))
				choice_right_array.push(1);
			else choice_right_array.push(0);					
		});
	}
	$(".explain_"+type).each(function (i) {
		if(i==0) var myStr_Explain = $(this).val();
		else var myStr_Explain = '"""'+$(this).val();	
		explain_array.push(myStr_Explain);			
		
	});	
	if(type=="part_point"){
		$(".point").each(function () {
			if($(this).val()!=""){
				point_array.push($(this).val());
			}
		});
	}
	var textarea_id = tinyMCE.activeEditor.editorId;
	var question_content = encodeURIComponent(tinyMCE.get(textarea_id).getContent());	
	var str = "type=" + type + "&no_right_choice=" + no_right_choice + "&right_answer" + right_answer + "&subject=" + subject + "&grade=" + grade + "&curriculum=" + curriculum + "&suffle=" + suffle + "&question_content=" + question_content + "&detailed_answer_array=" + detailed_answer_array + "&hint_array=" + hint_array + "&choice_array=" + choice_array + "&choice_right_array=" + choice_right_array + "&explain_array=" + explain_array + "&point_array=" + point_array;			
	ajax.open("POST", "../teacher/question/create_question", true);
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");	
	ajax.send(str);	
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			$("#list_questions").load("../teacher/question/load_data_manage_question");
			$("#list_answers_"+type)[0].reset();
			var textarea_id = tinyMCE.activeEditor.editorId;
			tinymce.get(textarea_id).setContent(''); 
			if(ajax.responseText.trim() === "Failed"){
				$('#alert').css({"display":"inline-block"});
				$('#alert').html("<div class=\"alert alert-error fade in\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Có lỗi khi tạo câu hỏi!</strong></div>");				
			}
			else{
				$('#alert').css({"display":"inline-block"});
				$('#alert').html("<div class=\"alert alert-success fade in\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Bạn đã tạo câu hỏi "+ajax.responseText+" thành công</strong></div>");
			}
		}
	}	
}

function edit_question(type,question_id){
	var ajax = new XMLHttpRequest();
	var detailed_answer_array = [];
	var hint_array = [];
	var choice_array = [];
	var choice_right_array = [];
	var explain_array = [];
	var point_array = [];
	var subject = $("#subject").val();
	var grade = $("#grade").val();
	var curriculum = $("#curriculum").val();
	if($("#all_wrong"+type).is(':checked')){
		var no_right_choice = 1;
		var right_answer = $("#right_answer"+type).val();
	}
	else{
		var no_right_choice = 0;
		var right_answer = null;
	}
	if($("#suffle_answer").is(':checked') || !$(this).closest('div').hasClass("off")) var suffle = 1;
	else var suffle = 0;
	$(".detailed_answer_"+type).each(function (i) {	
		if(i==0) var myStr_Detail = $(this).val();
		var myStr_Detail = '"""'+$(this).val();
		detailed_answer_array.push(myStr_Detail);
	});
	$(".hint_"+type).each(function (i) {
		if(i==0) var myStr_Hint = $(this).val();
		else var myStr_Hint = '"""'+$(this).val();
		hint_array.push(myStr_Hint);
	});
	$(".choice_"+type).each(function (i) {
		if(i==0) var myStr_Choice = $(this).val();
		else var myStr_Choice = '"""'+$(this).val();
		choice_array.push(myStr_Choice);
	});
	if(type==="0104"||type==="0105"||type==="0101"){
		$(".choice_right_"+type).each(function () {
			if($(this).is(':checked') || !$(this).closest('div').hasClass("off"))
				choice_right_array.push(1);
			else choice_right_array.push(0);					
		});
	}
	$(".explain_"+type).each(function (i) {
		if(i==0) var myStr_Explain = $(this).val();
		else var myStr_Explain = '"""'+$(this).val();	
		explain_array.push(myStr_Explain);			
		
	});	
	if(type=="0105"){
		$(".point").each(function () {
			if($(this).val()!=""){
				point_array.push($(this).val());
			}
		});
	}
	var textarea_id = tinyMCE.activeEditor.editorId;
	var question_content = encodeURIComponent(tinyMCE.get(textarea_id).getContent());
	var str = "question_id="+question_id+"&type=" + type + "&no_right_choice=" + no_right_choice + "&right_answer" + right_answer + "&subject=" + subject + "&grade=" + grade + "&curriculum=" + curriculum + "&suffle=" + suffle + "&question_content=" + question_content + "&detailed_answer_array=" + detailed_answer_array + "&hint_array=" + hint_array + "&choice_array=" + choice_array + "&choice_right_array=" + choice_right_array + "&explain_array=" + explain_array + "&point_array=" + point_array;			
	ajax.open("POST", "../teacher/question/edit_question", true);
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");	
	ajax.send(str);	
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			/*
			$("#create_edit_question").load("../teacher/question/load_data_create_question");					
			
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
		     */
			$("#list_questions").load("../teacher/question/load_data_manage_question");
			if(ajax.responseText.trim() === "Success") window.location = "../teacher/question";
			else{
				$('.alert-error').css({"display":"inline-block"});
				$('.alert-error').addClass('fade');
				$('.alert-error').addClass('in');	
			}
		}
	}	
}

function delete_question(question_id){	
	var ajax = new XMLHttpRequest();
	var str = "question_id="+question_id;			
	ajax.open("POST", "../teacher/question/delete_question", true);
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");	
	ajax.send(str);	
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if(ajax.responseText.trim() === "Success"){
				$("#list_questions").load("../teacher/question/load_data_manage_question");
			}
			/*
			if(ajax.responseText.trim() === "Success"){
				document.getElementById('alert').style.display = "inline-block";
				$('.alert').addClass('fade');
				$('.alert').addClass('in');
			}
			else{
				document.getElementById('error').style.display = "inline-block";
				$('.alert').addClass('fade');
				$('.alert').addClass('in');
			}
			*/
		}
	}
}