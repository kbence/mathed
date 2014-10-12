<?php

class Document
{
    protected $dbConnection;

    public function __construct(CDbConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function save($documentId, $content)
    {
        $cmd = $this->dbConnection->createCommand(
            'INSERT INTO document SET ' .
            'owner = -1, ' .
            'title = "", ' .
            'content = :content'
        );

        $cmd->execute(array('content' => $content));
    }
}
