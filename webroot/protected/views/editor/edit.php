<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
/* @var CClientScript $clientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCoreScript('jquery');
$clientScript->registerScriptFile('/js/default.js');
$clientScript->registerScriptFile('/js/editor.js', CClientScript::POS_END);
$clientScript->registerCssFile('/css/default.css');
$clientScript->registerCssFile('/css/editor.css');
?>
<script language="javascript">
    <!--
    var currentDocumentId = <?php echo $document['id'] ?>;
    // -->
</script>

Editor
<button onclick="Editor.save()">Save</button>
<button onclick="Editor.saveAndPreview()">Save & preview</button>
<span id="progress-text"></span>
<div id="wl_document" onMouseUp="moveDividerOut()">
    <div id="wl_editor">
        <pre id="editor"><?php echo $document['content'] ?></pre>
    </div>
    <div id="wl_divider" onMouseMove="moveDivider()" onmousedown="moveDividerClick()"
         onmouseup="moveDividerOut()"></div>
    <div id="wl_preview">
        <img src="/images/bear.jpg" alt="bear" style="width:100%"/>
    </div>
</div>


