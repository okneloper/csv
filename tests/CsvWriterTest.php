<?php

require_once __DIR__ . '/WritingTest.php';

use Okneloper\Csv\CsvWriter;

class CsvWriterTest extends WritingTest
{
    public function testItWrites()
    {
        $stream = new \Okneloper\Csv\Stream\Output\PhpOutputStream();
        $writer = new CsvWriter($stream);

        ob_start();
        array_map([$writer, 'write'], $this->dataAsArray);
        $output = ob_get_clean();

        $this->assertEquals($this->dataAsString, $output);


        /*
        array_map(function ($row) use ($writer) {
            $writer->write($row);
        }, $this->dataAsArray);
        */
    }
}
