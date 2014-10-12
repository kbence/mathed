<?php

class PdfToPngConversion extends Conversion
{
    public function getDefaultInputExtension()
    {
        return '.pdf';
    }

    public function getDefaultOutputExtension()
    {
        return '.png';
    }

    protected function convertFile($file)
    {
        $tempDir = $this->createTempDirectory();

        $result = $this->execute(array('cwd' => $tempDir),
            'convert', $file, '-density', '300', '-background', 'white',
            '-alpha', 'off', 'target.png');

        if ($result['status'] == 'OK') {
            if ($result['exitcode'] == 0) {
                if ($dir = opendir($tempDir)) {
                    $outputFiles = array();

                    while ($outputFile = readdir($dir)) {
                        $filename = $tempDir . '/' . $outputFile;

                        if (substr($filename, -4) == '.png') {
                            $outputFiles[] = $filename;
                        }
                    }

                    sort($outputFiles);
                    $this->addOutputFile($outputFiles);
                }
            } else {
                throw new Exception(
                    "Failed to execute convert!\n\n" .
                    "STDOUT:\n" .
                    "{$result['stdout']}:\n\n" .
                    "STDERR:\n" .
                    "{$result['stderr']}:\n"
                );
            }
        } else {
            throw new Exception($result['message']);
        }
    }
}
