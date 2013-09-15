var hidden = $('<span id="hidden" style="display:none;"></span>');
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
	    MathJax.Hub.Queue(["Typeset",MathJax.Hub,"choice"+order+"_"+array[1]+"_width"]);
	});	
});