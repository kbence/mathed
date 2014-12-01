<?php

class DocumentModel extends CActiveRecord
{
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

    public static function create()
    {
        $document = new DocumentModel();
        $document->title = 'Untitled document';
        $document->content = self::loadTemplate('article');
        $document->owner = Yii::app()->user->id;

        if ($document->save())
            return $document->id;

        return null;
    }

    private static function loadTemplate($templateName)
    {
        if (substr($templateName, -4) != '.tex') {
            $templateName .= '.tex';
        }

        return file_get_contents(Yii::app()->params['document']['templateDir'] . '/' . $templateName);
    }
}

