tinyMCE.init({
	mode : "specific_textareas",
	editor_selector : "editor",
	theme : "advanced",
	height: "150",
	theme_advanced_buttons1 : "fontselect,fontsizeselect,bold,italic,underline,strikethrough,separator,sub,sup,separator,cut,copy,paste,undo,redo",
	theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,separator,numlist,bullist,outdent,indent,separator,forecolor,separator,hr,link,unlink,image,media,table,code,separator,asciimath,asciimathcharmap,asciisvg",
	theme_advanced_buttons3 : "",
	theme_advanced_fonts : "Arial=arial,helvetica,sans-serif,Courier New=courier new,courier,monospace,Georgia=georgia,times new roman,times,serif,Tahoma=tahoma,arial,helvetica,sans-serif,Times=times new roman,times,serif,Verdana=verdana,arial,helvetica,sans-serif",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_resizing: false,
	theme_advanced_statusbar_location : "bottom",
	plugins : 'asciimath,asciisvg,table,inlinepopups,media,autoresize',
	autoresize_min_height : "150",
	setup : function(ed) {
	    ed.onKeyUp.add(function(ed, e) {
	        //console.debug('Key up event: ' + e.keyCode);
	        var textarea_id = tinyMCE.activeEditor.editorId;
	        var id_array = textarea_id.split("_");
	        var question_content = tinyMCE.get(textarea_id).getContent();
	        alert(textarea_id);
	        $('#preview_question_'+id_array[2]).html(question_content);
	        MathJax.Hub.Queue(["Typeset",MathJax.Hub,"preview_question_"+id_array[2]]);
	        //document.getElementByClass('question_content_trad').innerHTML = question_content;
	    });
	},
	AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php',			      //change me  
	ASdloc : 'http://www.imathas.com/editordemo/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  	
	content_css : "../public/css/content.css"		       
});	