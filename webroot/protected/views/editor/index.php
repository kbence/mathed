<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
/* @var CClientScript $clientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCoreScript('jquery');
?>

<h1>Own documents</h1>
<a href="<?php echo $this->createUrl('new') ?>">Create new</a>
<?php $this->renderPartial('document_list', array('documents' => $documents, 'edit' => true)) ?>

<h1>Shared documents</h1>
<?php $this->renderPartial('document_list', array('documents' => $shared_documents, 'edit' => false)) ?>

