<?php

class Document
{
    protected $dbConnection;

    public function __construct(CDbConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function saveNew($title, $content)
    {
        $cmd = $this->dbConnection->createCommand(
            'INSERT INTO document SET ' .
            'owner = -1, ' .
            'title = :title, ' .
            'content = :content'
        );

        $transaction = $this->dbConnection->beginTransaction();
        $cmd->execute(array(
            'content' => $content,
            'title' => $title
        ));
        $newDocumentId = $this->dbConnection->getLastInsertID();
        $transaction->commit();

        return $newDocumentId;
    }

    public function save($documentId, $title, $content)
    {
        $cmd = $this->dbConnection->createCommand(
            'UPDATE document SET ' .
                'title = :title, ' .
                'content = :content ' .
            'WHERE id = :id'
        );

        return $cmd->execute(array(
            'id' => $documentId,
            'content' => $content,
            'title' => $title
        ));
    }

    public function load($documentId)
    {
        $cmd = $this->dbConnection->createCommand(
            'SELECT * FROM document WHERE id = :id'
        );

        return $cmd->queryRow(true, array(
            'id' => $documentId
        ));
    }

    public function listDocuments()
    {
        $cmd = $this->dbConnection->createCommand(
            'SELECT id, title FROM document'
        );

        return $cmd->queryAll(true);
    }
}
