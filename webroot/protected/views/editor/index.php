<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
Yii::app()->clientScript->registerCoreScript('jquery');
?>

<h2>Edit page</h2>

<style>
    #editor {
        margin: 0;
        width: 100%;
        height: 400px;
    }
</style>

<pre id="editor">\begin{page}
    Page content
\end</pre>

<script language="javascript">
<!--
$(function() {
    var editor = ace.edit('editor');
    editor.setTheme('ace/theme/dawn');
    editor.getSession().setMode('ace/mode/tex');
})
// -->
</script>
