<?php

class EditorController extends AuthController
{
    public function actions()
    {
        return array(
            'page' => array(
                'class' => 'CViewAction'
            )
        );
    }

    public function actionIndex()
    {
        $userId = Yii::app()->user->id;

        $this->render('index', array(
            'documents' => Document::model()->findAllByAttributes(array('owner' => $userId))
        ));
    }

    public function actionNew()
    {
        $documentId = Document::create();
        $this->redirect($this->createUrl('edit', array('id' => $documentId)));
    }

    public function actionEdit()
    {
        /** @var CClientScript $cs */
        $baseUrl = Yii::app()->request->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($baseUrl . '/js/ace-builds/src-noconflict/ace.js',
            CClientScript::POS_END);

        $documentId = $this->getRequest()->getParam('id');
        $document = Document::model()->findByPk($documentId);

        if ($document->owner == Yii::app()->user->id) {
            $this->render('edit', array('model' => $document));
        } else {
            $this->render('unauthorized');
        }
    }
}
