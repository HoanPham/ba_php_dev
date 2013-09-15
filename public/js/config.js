/* Initalize tinymce */
tinyMCE.init({
	mode : "textareas",
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
	        var textarea_id = tinyMCE.activeEditor.editorId;
	        var id_array = textarea_id.split("_");
	        var question_content = tinyMCE.get(textarea_id).getContent();
	        //alert(textarea_id);
	        $('#preview_question_'+id_array[2]).html(question_content);	        
	        MathJax.Hub.Queue(["Typeset",MathJax.Hub,"preview_area"]);
	    });
	},
	AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php',			      //change me  
	ASdloc : 'http://www.imathas.com/editordemo/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  	
	content_css : "../public/css/content.css"		       
});

/* MathJax config */
MathJax.Hub.Config({
	tex2jax: {inlineMath: [["$","$"]]},
	displayAlign: "center",
	displayIndent: "0.1em",
	"HTML-CSS": {
		scale: 88,
		minScaleAdjust: 88,
		availableFonts: ["TeX"],
		showMathMenu: false
	},
	MMLorHTML: {prefer: "HTML"}
});
MathJax.Hub.Register.StartupHook("HTML-CSS Jax Ready",function () {
  var VARIANT = MathJax.OutputJax["HTML-CSS"].FONTDATA.VARIANT;
  VARIANT["normal"].fonts.unshift("MathJax_Main");
  VARIANT["bold"].fonts.unshift("MathJax_Main");
  VARIANT["italic"].fonts.unshift("MathJax_Main");
  VARIANT["-tex-mathit"].fonts.unshift("MathJax_Main-italic");
});
MathJax.Hub.Register.StartupHook("SVG Jax Ready",function () {
  var VARIANT = MathJax.OutputJax.SVG.FONTDATA.VARIANT;
  VARIANT["normal"].fonts.unshift("MathJax_Main");
  VARIANT["bold"].fonts.unshift("MathJax_Main");
  VARIANT["italic"].fonts.unshift("MathJax_Main");
  VARIANT["-tex-mathit"].fonts.unshift("MathJax_Main-italic");
});
var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";  //change me
$(document).ready(function(){
	MathJax.Hub.Queue(["Typeset",MathJax.Hub,"preview_area"]);
    $('textarea').autosize();   
});	