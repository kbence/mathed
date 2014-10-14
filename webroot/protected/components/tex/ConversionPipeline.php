<?php

class ConversionPipeline {
    /**
     * @var Conversion[]
     */
    protected $conversions = array();

    /**
     * @var FileUtil
     */
    protected $fileUtil;

    function __construct(FileUtil $fileUtil = null)
    {
        $this->fileUtil = $fileUtil ? $fileUtil : new FileUtil();
    }


    public function addConversion(Conversion $conversion)
    {
        $this->conversions[] = $conversion;
    }

    public function convertContent($content)
    {
        $pendingConversions = $this->conversions;

        foreach ($pendingConversions as $numConversion => $conversion) {
            /** @var Conversion $lastConversion */

            if (isset($lastConversion)) {
                $conversion->addInputFile($lastConversion->getOutputFiles());
            } else {
                $conversion->saveAsInputFile($content, $conversion->getDefaultInputExtension());
            }

            $conversion->convert();
            $lastConversion = $conversion;
        }

        // load final output
        $outputContents = array();

        if (isset($lastConversion)) {
            foreach ($lastConversion->getOutputFiles() as $fileIndex => $outputFile) {
                $outputContents[$fileIndex] = $this->fileUtil->getContents($outputFile);
            }
        }

        return $outputContents;
    }

    public function cleanup()
    {
        foreach ($this->conversions as $conversion) {
            $conversion->cleanup();
        }
    }
}
