<?php

class AjaxController extends Controller
{
    public function actions()
    {
    }

    public function actionSaveDocument()
    {
        $documentId = $this->getRequest()->getParam('document_id', -1);
        $source = $this->getRequest()->getParam('tex');
        $document = new Document($this->getDatabase());
        $document->save($documentId, $source);
    }

    public function actionGenerateDocument()
    {
        $result = array();
        $documentId = $this->getRequest()->getParam('document_id', -1);
        $source = $this->getRequest()->getParam('tex');

        try {
            $cache = new DocumentCache($this->getDatabase());
            $cache->convertTexDocument($documentId, $source);

            $result['status'] = 'OK';
        } catch (Exception $e) {
            $result['status'] = 'Error';
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
    }

    public function actionGetImage()
    {
    }
}
