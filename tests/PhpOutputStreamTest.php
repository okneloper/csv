<?php

require_once __DIR__ . '/WritingTest.php';

use Okneloper\Csv\Stream\Output\PhpOutputStream;

class PhpOutputStreamTest extends WritingTest
{
    public function testItOutputs()
    {
        $stream = new PhpOutputStream();

        $data = $this->dataAsArray;

        ob_start();
        $stream->writeRow(new \Okneloper\Csv\CsvRow($data[0], 1));
        $stream->writeRow(new \Okneloper\Csv\CsvRow($data[1], 2));
        $output = ob_get_clean();

        $this->assertEquals($this->dataAsString, $output);
    }
}
