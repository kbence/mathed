<?php

class AjaxController extends AuthController
{
//    public function actions()
//    {
//    }

    public function actionSaveDocument()
    {
        $documentId = $this->getRequest()->getParam('id', -1);
        $source = $this->getRequest()->getParam('tex');
        $title = $this->getRequest()->getParam('title');

        $document = new Document($this->getDatabase());
        $result = array();

        if ($documentId == -1) {
            $newId = $document->saveNew($title, $source);
            $result['status'] = 'OK';
            $result['id'] = $newId;
        } else {
            $document->save($documentId, $title, $source);
            $result['status'] = 'OK';
        }
        echo json_encode($result);
    }

    public function actionGenerateDocument()
    {
        $result = array();
        $documentId = $this->getRequest()->getParam('id');
        $source = $this->getRequest()->getParam('tex');

        try {
            $cache = new DocumentCache($this->getDatabase());
            $cache->convertTexDocument($documentId, $source);

            $parts = $cache->listDocumentParts($documentId, 'png');
            $imageUrls = array();
            foreach ($parts as $part) {
                $imageUrls[] = $this->createUrl('getImage', array(
                    'id' => $documentId,
                    'part' => $part,
                    'random' => microtime(true)
                ));
            }

            $result['status'] = 'OK';
            $result['images'] = $imageUrls;
            $result['parts'] = $parts;
        } catch (Exception $e) {
            $result['status'] = 'Error';
            $result['message'] = $e->getMessage();
        }

        $this->jsonResponse($result);
    }

    public function actionGetImage()
    {
        $documentId = $this->getRequest()->getParam('id');
        $part = $this->getRequest()->getParam('part', 0);
        $cache = new DocumentCache($this->getDatabase());
        $content = $cache->getPngImage($documentId, $part);

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
