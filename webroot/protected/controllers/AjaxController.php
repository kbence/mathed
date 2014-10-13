<?php

class AjaxController extends Controller
{
    public function actions()
    {
    }

    public function actionSaveDocument()
    {
        $documentId = $this->getRequest()->getParam('id', -1);
        $source = $this->getRequest()->getParam('tex');
        $document = new Document($this->getDatabase());
        $result = array();

        if ($documentId == -1) {
            $newId = $document->saveNew($source);
            $result['status'] = 'OK';
            $result['id'] = $newId;
        } else {
            $document->save($documentId, $source);
            $result['status'] = 'OK';
        }
        echo json_encode($result);
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

        $this->jsonResponse($result);
    }

    public function actionGetImage()
    {
        $documentId = $this->getRequest()->getParam('document_id');
        $cache = new DocumentCache($this->getDatabase());
        $content = $cache->getPngImage($documentId);

        header('Content-Type: image/png');
        echo $content;
    }

    protected function jsonResponse(array $array)
    {
        $json = json_encode($array);
        header('Content-Type: application/json');
        header('Content-Length: ' . strlen($json));
        echo $json;
    }
}
