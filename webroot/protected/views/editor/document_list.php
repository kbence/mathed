
<table>
    <?php foreach ($documents as $doc): ?>
        <tr>
            <td><?php echo $doc->title ?></td>
            <td>
                <?php if ($edit): ?>
                    <a href="?r=editor/edit&amp;id=<?php echo $doc->id ?>">Edit</a>
                <?php else: ?>
                    <a href="?r=editor/view&amp;id=<?php echo $doc->id ?>">View</a>
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>
