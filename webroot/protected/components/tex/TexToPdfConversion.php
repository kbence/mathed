<?php

class TexToPdfConversion extends Conversion
{
    const INPUT_SUFFIX = '.tex';
    const OUTPUT_SUFFIX = '.pdf';

    public function __construct()
    {
    }

    public function getDefaultInputExtension()
    {
        return '.tex';
    }

    public function getDefaultOutputExtension()
    {
        return '.pdf';
    }

    protected function convertFile($file)
    {
        $pdfFile = null;

        $texDir = dirname($file);
        $texBasename = basename($file, self::INPUT_SUFFIX);

        $result = $this->execute(array('cwd' => $texDir, 'timeout' => 5),
            'pdflatex', '-interaction', 'nonstopmode', $texBasename . self::INPUT_SUFFIX);

        if ($result['status'] == 'OK') {
            $expectedOutput = $texDir . '/' . $texBasename . self::OUTPUT_SUFFIX;

            if (file_exists($expectedOutput)) {
                $pdfFile = $expectedOutput;
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

