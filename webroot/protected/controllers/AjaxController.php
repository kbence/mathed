<?php

class AjaxController extends AuthController
{
    public function actionSaveDocument()
    {
        $request = $this->getRequest();
        $documentId = $request->getParam('id', -1);
        $content = $request->getParam('tex');
        $title = $request->getParam('title');
        $shared = $request->getParam('shared');

        if ($documentId == -1) {
            $document = new Document();
        } else {
            $document = Document::model()->findByPk($documentId);
        }

        $result = array();

        if ($document) {
            $document->id = $documentId;
            $document->title = $title;
            $document->content = $content;
            $document->shared = strtolower($shared) == 'true' ? 1 : 0;

            $result['doc'] = print_r($shared, true);

            if ($document->save()) {
                $result['status'] = 'OK';
            } else {
                $result['status'] = 'Error';
            }
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
