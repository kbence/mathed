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
    var currentDocumentId = <?php echo $model->id ?>;
// -->
</script>

Title: <input type="text" id="document-title" size="64" value="<?php echo $model->title ?>"/>

<button onclick="Editor.save()">Save</button>
<button onclick="Editor.saveAndPreview()">Save & preview</button>
Share:<label id="checkbox_in"><input id="cb_shared" type="checkbox" /></label>
<span id="progress-text"></span><br/>

<div id="toolbar"></div>

<div id="wl_document" onMouseUp="moveDividerOut()">
    <div id="wl_editor">
        <pre id="editor"><?php echo $model->content ?></pre>
    </div>
    <div id="wl_divider" onMouseMove="moveDivider()" onmousedown="moveDividerClick()"
         onmouseup="moveDividerOut()"></div>
    <div id="wl_preview">
    </div>
</div>

<?php $this->renderPartial('comment.views.comment.commentList', array('model' => $model)) ?>


