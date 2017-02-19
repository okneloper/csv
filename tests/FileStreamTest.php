<?php

require_once __DIR__ . '/WritingTest.php';

use Okneloper\Csv\Stream\Output\FileStream;

class FileStreamTest extends WritingTest
{
    protected $destination_file = "./tests/tmp/new_file.csv";

    protected function setUp()
    {
        if (file_exists($this->destination_file)) {
            unlink($this->destination_file);
        }
    }

    protected function tearDown()
    {
        if (file_exists($this->destination_file)) {
            unlink($this->destination_file);
        }
    }

    public function testItOpensStreamAutomtically()
    {
        $file = $this->destination_file;

        $stream = new FileStream($file);

        $stream->writeRow(new \Okneloper\Csv\CsvRow(['x'], 1));

        // if there are no errors/exceptions test passed
    }

    public function testItWorksWithStreamPreOpened()
    {
        $file = $this->destination_file;

        $stream = new FileStream($file);
        $stream->open();

        $stream->writeRow(new \Okneloper\Csv\CsvRow(['x'], 1));

        // if there are no errors/exceptions test passed
    }

    public function testItCreatesNewFile()
    {
        $file = $this->destination_file;

        $stream = new FileStream($file);
        // this should create the file
        $stream->open();
        $this->assertFileExists($file);

        // this closes the file and makes it available for deletion
        unset($stream);
    }

    public function testItWritesDataIntoFile()
    {
        $file = $this->destination_file;

        $stream = new FileStream($file);
        $stream->open();

        $data = $this->dataAsArray;

        $stream->writeRow(new \Okneloper\Csv\CsvRow($data[0], 1));
        $stream->writeRow(new \Okneloper\Csv\CsvRow($data[1], 2));

        $this->assertEquals($this->dataAsString, file_get_contents($file));
    }
}
