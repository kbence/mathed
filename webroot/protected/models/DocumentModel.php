<?php

class DocumentModel extends CActiveRecord
{
    public $id;

    public function tableName()
    {
        return 'document';
    }

    public function behaviors()
    {
        return array(
            'commentable' => array(
                'class' => 'ext.comment-module.behaviors.CommentableBehavior',
                'mapTable' => 'document_comment',
                'mapRelatedColumn' => 'documentId',
            )
        );
    }
}

