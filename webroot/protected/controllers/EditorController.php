<?php

class EditorController extends Controller
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
        $document = new Document($this->getDatabase());
        $docs = $document->listDocuments();

        $this->render('index', array(
            'documents' => $docs
        ));
    }

    public function actionNew()
    {
        $templateDir = dirname(__FILE__) . '/../data/templates';

        $fileUtil = new FileUtil();
        $document = new Document($this->getDatabase());
        $documentId = $document->saveNew('Untitled document', $fileUtil->getContents($templateDir . '/article.tex'));

        $this->redirect($this->createUrl('edit', array('id' => $documentId)));
    }

    public function actionEdit()
    {
        /** @var CClientScript $cs */
        $documentId = $this->getRequest()->getParam('id');
        $document = new Document($this->getDatabase());
        $doc = $document->load($documentId);

        $baseUrl = Yii::app()->request->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($baseUrl . '/js/ace-builds/src-noconflict/ace.js',
            CClientScript::POS_END);

        $this->render('edit', array(
            'document' => $doc
        ));
    }
}
