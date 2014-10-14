<?php

class DocumentCache
{
    /** @var CDbConnection */
    protected $dbConnetion;

    /** @var ConversionPipelineFactory */
    protected $pipelineFactory;

    public function __construct(CDbConnection $dbConnection)
    {
        $this->dbConnetion = $dbConnection;
        $this->pipelineFactory = new ConversionPipelineFactory();
    }

    public function convertTexDocument($documentId, $texSource)
    {
        $conversion = $this->pipelineFactory->createTexToPngPipeline();
        $conversionResult = $conversion->convertContent($texSource);
        $conversion->cleanup();

        $this->cleanCache($documentId, 'png');

        $cmd = $this->dbConnetion->createCommand(
            'INSERT INTO document_cache SET ' .
            'document_id = :document_id, ' .
            'part = :part, ' .
            'type = :type, ' .
            'content = :content'
        );

        foreach ($conversionResult as $part => $result) {
            $cmd->execute(array(
                'document_id' => $documentId,
                'part' => $part,
                'type' => 'png',
                'content' => $result,
            ));
        }
    }

    public function listDocumentParts($documentId, $type)
    {
        $cmd = $this->dbConnetion->createCommand(
            'SELECT part FROM document_cache ' .
            'WHERE document_id = :id ' .
            'AND type = :type'
        );

        $rows = $cmd->queryAll(true, array('id' => $documentId, 'type' => $type));
        $parts = array();

        foreach ($rows as $row) {
            $parts[] = $row['part'];
        }

        return $parts;
    }

    public function getPngImage($documentId, $part = 0)
    {
        $cmd = $this->dbConnetion->createCommand(
            'SELECT content FROM document_cache ' .
            'WHERE document_id = :document_id ' .
            'AND part = :part'
        );

        $content = $cmd->queryScalar(array(
            'document_id' => $documentId,
            'part' => $part
        ));;

        return $content;
    }

    public function cleanCache($documentId, $type)
    {
        $cmd = $this->dbConnetion->createCommand(
            'DELETE FROM document_cache ' .
            'WHERE document_id = :id ' .
            'AND type = :type'
        );

        return $cmd->execute(array(
            'id' => $documentId,
            'type' => $type
        ));
    }
}

