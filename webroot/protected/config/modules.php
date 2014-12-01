<?php

return array(
    'comment' => array(
        'class'=>'ext.comment-module.CommentModule',
        'commentableModels'=>array(
            'document'=>'Document'
        ),
        'userModelClass'=>'User',
        'userNameAttribute'=>'name',
    )
);
