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
}

