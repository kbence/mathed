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
            'documents' => DocumentModel::model()->findAll()
        ));
    }

    public function actionNew()
    {
        $documentId = DocumentModel::create();
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
        $document = DocumentModel::model()->findByPk($documentId);

        $this->render('edit', array('model' => $document));
    }
}
