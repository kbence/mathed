
<table>
    <tr>
        <th><b>Document name</b></th>
        <th><b>Owner</b></th>
        <th><b>Operations</b></th>
    </tr>
    <?php foreach ($documents as $doc): ?>
        <tr>
            <td><?php echo $doc->title ?></td>
            <td><?php echo $users[$doc->owner]->name ?></td>
            <td>
                <?php if ($edit): ?>
                    <a href="?r=editor/edit&amp;id=<?php echo $doc->id ?>">Edit</a>
                <?php endif ?>
                <a href="?r=editor/view&amp;id=<?php echo $doc->id ?>">View</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
