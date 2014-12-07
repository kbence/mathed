
<h1><?php echo $document->title ?></h1>

<?php foreach ($imageUrls as $id => $url): ?>
    <img src="<?php echo $url ?>" alt="Page <?php echo $id + 1 ?>" width="100%"/>
<?php endforeach ?>

<?php $this->renderPartial('comment.views.comment.commentList', array('model' => $document)) ?>
