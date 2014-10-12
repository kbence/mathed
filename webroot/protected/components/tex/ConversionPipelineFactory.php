<?php

class ConversionPipelineFactory
{
    /**
     * @return ConversionPipeline
     */
    public function createTexToPngPipeline()
    {
        $pipeline = new ConversionPipeline();
        $pipeline->addConversion(new TexToPdfConversion());
        $pipeline->addConversion(new PdfToPngConversion());

        return $pipeline;
    }
}
