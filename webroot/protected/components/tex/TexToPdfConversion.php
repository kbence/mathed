<?php

class TexToPdfConversion extends Conversion
{
    public function __construct($texSource)
    {
        $this->texSource = $texSource;
    }

    public function convert()
    {
        $pdfFile = null;

        $texFile = $this->saveContent($this->texSource, '/document.tex');
        $texDir = dirname($texFile);
        $this->addFileToCleanup($texDir);

        $result = $this->execute(array('cwd' => $texDir, 'timeout' => 5),
            'pdflatex', '-interaction', 'nonstopmode', 'document.tex');

        if ($result['status'] == 'OK') {
            if (file_exists($texDir . '/document.pdf')) {
                $pdfFile = $texDir . '/document.pdf';
            } else {
                throw new Exception(
                    "Error occured while running pdftex:\n\n" .
                    "STDOUT:\n" .
                    "{$result['stdout']}\n\n" .
                    "STDERR:\n" .
                    "{$result['stderr']}\n"
                );
            }
        } else {
            throw new Exception($result['message']);
        }

        $this->addOutputFile($pdfFile);
    }
}

