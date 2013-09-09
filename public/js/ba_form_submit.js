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
	if($("#suffle_answer").is(':checked')) var suffle = 1;
	else var suffle = 0;
	//var i = 0;
	$(".detailed_answer_"+type).each(function (i) {	
		if(i==0) var myStr_Detail = $(this).val();
		var myStr_Detail = '"""'+$(this).val();
		detailed_answer_array.push(myStr_Detail);
	});
	$(".hint_"+type).each(function (i) {
		if(i==0) var myStr_Hint = $(this).val();
		else var myStr_Hint = '"""'+$(this).val();
		hint_array.push(myStr_Hint);
		//}
	});
	$(".choice_"+type).each(function (i) {
		if(i==0) var myStr_Choice = $(this).val();
		else var myStr_Choice = '"""'+$(this).val();
		choice_array.push(myStr_Choice);
	});
	if(type==="0104"||type==="0105"||type==="0101"){
		$(".choice_right_"+type).each(function () {
			if($(this).is(':checked'))
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
	//alert(question_content);
	var str = "type=" + type + "&no_right_choice=" + no_right_choice + "&right_answer" + right_answer + "&subject=" + subject + "&grade=" + grade + "&curriculum=" + curriculum + "&suffle=" + suffle + "&question_content=" + question_content + "&detailed_answer_array=" + detailed_answer_array + "&hint_array=" + hint_array + "&choice_array=" + choice_array + "&choice_right_array=" + choice_right_array + "&explain_array=" + explain_array + "&point_array=" + point_array;			
	ajax.open("POST", "../teacher/question/create_question", true);
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");	
	ajax.send(str);	
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			alert(ajax.responseText);
			//document.getElementById("myTab_multiple_choice").innerHTML = ajax.responseText;
			/*
			if(ajax.responseText.trim() === "Success"){
				document.getElementById('form_create').reset();
				//document.getElementById('form_message').innerHTML = ajax.responseText;
				//alert(ajax.responseText);
				document.getElementById('alert').style.display = "block";
				$('.alert').addClass('fade');
				$('.alert').addClass('in');
			}
			else{
				document.getElementById('error').style.display = "block";
				$('.alert').addClass('fade in');
				//$('.alert').addClass('in');
			}
			*/
		}
	}	
}