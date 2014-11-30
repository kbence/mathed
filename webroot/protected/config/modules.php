<?php

return array(
    'comment' => array(
        'class'=>'ext.comment-module.CommentModule',
        'commentableModels'=>array(
            'document'=>'DocumentModel'
        ),
        'userModelClass'=>'User',
        'userNameAttribute'=>'name',
    )
);
