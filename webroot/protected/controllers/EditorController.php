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

        $documents = Document::model()->findAllByAttributes(array('owner' => $userId));
        $sharedDocuments = Document::model()->findAllByAttributes(array('shared' => 1));
        $ownerIds = array_unique(array_merge(
            $this->extractAllOwners($documents),
            $this->extractAllOwners($sharedDocuments)
        ));
        $users = array_combine($ownerIds, array_map(array(User::model(), 'findByPk'), $ownerIds));

        $this->render('index', array(
            'documents' => $documents,
            'users' => $users,
            'shared_documents' => $sharedDocuments
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
            $imageUrls = $this->getPreviewUrls($documentId);
            $this->render('edit', array('document' => $document, 'imageUrls' => $imageUrls));
        } else {
            $this->render('unauthorized');
        }
    }

    public function actionView()
    {
        $documentId = $this->getRequest()->getParam('id');
        $document = Document::model()->findByPk($documentId);

        if ($document) {
            $links = $this->getPreviewUrls($documentId);

            $this->render('view', array('document' => $document, 'imageUrls' => $links));
        } else {
            $this->render('unauthorized');
        }
    }

    /**
     * @param $documentId
     * @return array
     */
    protected function getPreviewUrls($documentId)
    {
        $cache = new DocumentCache($this->getDatabase());
        $imageCount = $cache->getPngImageCount($documentId);
        $links = array();

        for ($image = 0; $image < $imageCount; $image++) {
            $links[] = $this->createUrl('ajax/getImage', array(
                'id' => $documentId,
                'part' => $image,
                'random' => microtime(true)
            ));
        }
        return $links;
    }

    /**
     * @param $documents Document[]
     */
    protected function extractAllOwners($documents)
    {
        $owners = array();

        foreach ($documents as $document) {
            $owners[] = $document->owner;
        }

        return array_unique($owners);
    }
}
