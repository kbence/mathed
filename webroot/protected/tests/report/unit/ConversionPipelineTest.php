<?php

class ConversionPipelineTest_DummyConversion extends Conversion {
    protected function convertFile($file) { }
}

class ConversionPipelineTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function convertContent_withNoConversion_returnsEmptyArray()
    {
        // Given
        $pipeline = new ConversionPipeline();

        // When
        $result = $pipeline->convertContent('some content');

        // Then
        $this->assertEquals(array(), $result);
    }

    /**
     * @test
     */
    public function convertContent_withOneConversion_callsConvert()
    {
        // Given
        $conversion = $this->getMock('ConversionPipelineTest_DummyConversion');
        $conversion->expects($this->at(0))->method('saveAsInputFile')->with('great content');
        $conversion->expects($this->at(1))->method('convert');
        $conversion->expects($this->at(2))->method('getOutputFiles')
            ->will($this->returnValue(array('file1', 'file2')));

        $fileUtil = $this->getMock('FileUtil');
        $fileUtil->expects($this->at(0))->method('getContents')->with('file1')
            ->will($this->returnValue('file1 contents'));
        $fileUtil->expects($this->at(1))->method('getContents')->with('file2')
            ->will($this->returnValue('file2 contents'));

        $pipeline = new ConversionPipeline($fileUtil);
        $pipeline->addConversion($conversion);

        // When
        $result = $pipeline->convertContent('great content');

        // Then
        $this->assertEquals(array('file1 contents', 'file2 contents'), $result);
    }

    /**
     * @test
     */
    public function convertContent_withTwoConversions_PipesThemCorrectly()
    {
        // Given
        $firstConversion = $this->getMock('ConversionPipelineTest_DummyConversion');
        $firstConversion->expects($this->at(0))->method('saveAsInputFile')->with('great content');
        $firstConversion->expects($this->at(1))->method('convert');
        $firstConversion->expects($this->at(2))->method('getOutputFiles')
            ->will($this->returnValue(array('file1', 'file2')));

        $secondConversion = $this->getMock('ConversionPipelineTest_DummyConversion');
        $secondConversion->expects($this->at(0))->method('addInputFile')->with(array('file1', 'file2'));
        $secondConversion->expects($this->at(1))->method('convert');
        $secondConversion->expects($this->at(2))->method('getOutputFiles')
            ->will($this->returnValue(array('file3', 'file4')));

        $fileUtil = $this->getMock('FileUtil');
        $fileUtil->expects($this->at(0))->method('getContents')->with('file3')
            ->will($this->returnValue('file3 contents'));
        $fileUtil->expects($this->at(1))->method('getContents')->with('file4')
            ->will($this->returnValue('file4 contents'));

        $pipeline = new ConversionPipeline($fileUtil);
        $pipeline->addConversion($firstConversion);
        $pipeline->addConversion($secondConversion);

        // When
        $result = $pipeline->convertContent('great content');

        // Then
        $this->assertEquals(array('file3 contents', 'file4 contents'), $result);
    }
    
    /**
     * @test
     */
    public function cleanup_default_callsCleanupOnAllConversions()
    {
        // Given
        $conversion1 = $this->getMock('ConversionPipelineTest_DummyConversion');
        $conversion1->expects($this->once())->method('cleanup');

        $conversion2 = $this->getMock('ConversionPipelineTest_DummyConversion');
        $conversion2->expects($this->once())->method('cleanup');

        $pipeline = new ConversionPipeline();
        $pipeline->addConversion($conversion1);
        $pipeline->addConversion($conversion2);

        // When, Then
        $pipeline->cleanup();
    }
}
