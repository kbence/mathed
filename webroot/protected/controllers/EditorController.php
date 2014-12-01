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
        $this->render('index', array(
            'documents' => Document::model()->findAll()
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

        $this->render('edit', array('model' => $document));
    }
}
