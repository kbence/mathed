<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
/* @var CClientScript $clientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCoreScript('jquery');
$clientScript->registerScriptFile('/js/divider.js');
$clientScript->registerScriptFile('/js/editor.js', CClientScript::POS_END);
$clientScript->registerCssFile('/css/divider.css');
$clientScript->registerCssFile('/css/editor.css');
?>

<script language="javascript">

    <!--
    var currentDocumentId = <?php echo $document['id'] ?>;
	
	$(document).ready(function(){
		$(".button-comparsion span").click(function(){
			var button_comparsion_position = $(".button-comparsion").position();		
			$(".comparsion").css("visibility","visible"); 
			$(".comparsion").css("top",button_comparsion_position.top+30+"px");	
			$(".comparsion").css("left",button_comparsion_position.left+"px");			
		});
		$(".button-leq span").click(function(){
			Editor.insert("\\leq");
			$(".comparsion").css("visibility","hidden"); 
		});
		$(".button-geq span").click(function(){
			Editor.insert("\\geq");
			$(".comparsion").css("visibility","hidden"); 
		});		
		$(".button-prec span").click(function(){
			Editor.insert("\\prec");
			$(".comparsion").css("visibility","hidden"); 
		});	
		$(".button-succ span").click(function(){
			Editor.insert("\\succ");
			$(".comparsion").css("visibility","hidden"); 
		});	
		$(".button-triangleleft span").click(function(){
			Editor.insert("\\triangleleft");
			$(".comparsion").css("visibility","hidden"); 
		});	
		$(".button-triangleright span").click(function(){
			Editor.insert("\\triangleright");
			$(".comparsion").css("visibility","hidden"); 
		});	
		$(".button-neq span").click(function(){
			Editor.insert("\\neq");
			$(".comparsion").css("visibility","hidden"); 
		});	
		$(".button-equiv span").click(function(){
			Editor.insert("\\equiv");
			$(".comparsion").css("visibility","hidden"); 
		});	
		$(".button-approx span").click(function(){
			Editor.insert("\\approx");
			$(".comparsion").css("visibility","hidden"); 
		});	
		$(".button-cong span").click(function(){
			Editor.insert("\\cong");
			$(".comparsion").css("visibility","hidden"); 
		});			
		$(".button-propto span").click(function(){
			Editor.insert("\\propto");
			$(".comparsion").css("visibility","hidden"); 
		});			
	});
    // -->
</script>

Editor

<div id="toolbar">
    <div class="button button-comparsion"><span>&nbsp;</span></div>
    <div class="button button-whitespaces"><span>&nbsp;</span></div>
    <div class="button button-accents"><span>&nbsp;</span></div>
	<div class="button button-binaryopeators"><span>&nbsp;</span></div>
    <div class="button button-arrows"><span>&nbsp;</span></div>
    <div class="button button-comparsion2"><span>&nbsp;</span></div>
	<div class="button button-sets"><span>&nbsp;</span></div>
    <div class="button button-diversesimbols"><span>&nbsp;</span></div>
    <div class="button button-greeksmall"><span>&nbsp;</span></div>
    <div class="button button-greeklarge"><span>&nbsp;</span></div>
	<div class="button button-boundaries"><span>&nbsp;</span></div>
    <div class="button button-mathematicalconstructions"><span>&nbsp;</span></div>
    <div class="button button-subscript"><span>&nbsp;</span></div>
    <div class="button button-operators"><span>&nbsp;</span></div>
    <div class="button button-abobebelow"><span>&nbsp;</span></div>		
	<div class="button button-arrowwithcaption"><span>&nbsp;</span></div>

	<div class="comparsion">
		<div class="button button-leq"><span>&nbsp;</span></div>
		<div class="button button-geq"><span>&nbsp;</span></div>
		<div class="button button-prec"><span>&nbsp;</span></div>
		<div class="button button-succ"><span>&nbsp;</span></div>
		<div class="button button-triangleleft"><span>&nbsp;</span></div>
		<div class="button button-triangleright"><span>&nbsp;</span></div>
		<div class="button button-neq"><span>&nbsp;</span></div>
		<div class="button button-equiv"><span>&nbsp;</span></div>
		<div class="button button-approx"><span>&nbsp;</span></div>
		<div class="button button-cong"><span>&nbsp;</span></div>
		<div class="button button-propto"><span>&nbsp;</span></div>		
	</div>
	
</div>
Title: <input type="text" id="document-title" size="64" value="<?php echo $document['title'] ?>"/>

<button onclick="Editor.save()">Save</button>
<button onclick="Editor.saveAndPreview()">Save & preview</button>
<span id="progress-text"></span><br/>


<div id="wl_document" onMouseUp="moveDividerOut()">
    <div id="wl_editor">
        <pre id="editor"><?php echo $document['content'] ?></pre>
    </div>
    <div id="wl_divider" onMouseMove="moveDivider()" onmousedown="moveDividerClick()"
         onmouseup="moveDividerOut()"></div>
    <div id="wl_preview">
    </div>
</div>


