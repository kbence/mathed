<?php

return array(
    'comment' => array(
        'class'=>'ext.comment-module.CommentModule',
        'commentableModels'=>array(
            'document'=>'DocumentModel'
        ),
        'userModelClass'=>'UserModel',
        'userNameAttribute'=>'name',
    )
);
