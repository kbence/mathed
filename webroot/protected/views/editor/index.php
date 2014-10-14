<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
/* @var CClientScript $clientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerCoreScript('jquery');
?>

<a href="<?php echo $this->createUrl('new') ?>">Create new</a>

<table>
    <?php foreach ($documents as $doc): ?>
        <tr>
            <td><?php echo $doc['title'] ?></td>
            <td><a href="?r=editor/edit&amp;id=<?php echo $doc['id'] ?>">Edit</a></td>
        </tr>
    <?php endforeach ?>
</table>
