<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
/* @var CClientScript $clientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCoreScript('jquery');
$clientScript->registerScriptFile('/js/divider.js');
$clientScript->registerScriptFile('/js/editor.js', CClientScript::POS_END);
$clientScript->registerScriptFile('/js/editor-toolbar.js', CClientScript::POS_END);
$clientScript->registerCssFile('/css/divider.css');
$clientScript->registerCssFile('/css/editor.css');
?>

<script language="javascript">
<!--
    var currentDocumentId = <?php echo $document['id'] ?>;
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


