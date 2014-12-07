
<h1><?php echo $title ?></h1>

<?php foreach ($links as $id => $link): ?>
    <img src="<?php echo $link ?>" alt="Page <?php echo $id + 1 ?>" width="100%"/>
<?php endforeach ?>
