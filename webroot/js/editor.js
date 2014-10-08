$(function() {
	var editor = ace.edit('editor');
	editor.setTheme('ace/theme/dawn');
	editor.getSession().setMode('ace/mode/tex');
});
