<?php

class Document
{
    protected $dbConnection;

    public function __construct(CDbConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function saveNew($content)
    {
        $cmd = $this->dbConnection->createCommand(
            'INSERT INTO document SET ' .
            'owner = -1, ' .
            'title = "", ' .
            'content = :content'
        );

        $transaction = $this->dbConnection->beginTransaction();
        $cmd->execute(array('content' => $content));
        $newDocumentId = $this->dbConnection->getLastInsertID();
        $transaction->commit();

        return $newDocumentId;
    }

    public function save($documentId, $content)
    {
        $cmd = $this->dbConnection->createCommand(
            'UPDATE document SET ' .
                'title = "", ' .
                'content = :content ' .
            'WHERE id = :document_id'
        );

        return $cmd->execute(array(
            'document_id' => $documentId,
            'content' => $content,
        ));
    }
}
