<?php

use Okneloper\Csv\Stream\Output\TempFileStream;
use PHPUnit\Framework\TestCase;

class TempFileOutputStreamTest extends TestCase
{
    public function testItCreatesFile()
    {
        $stream = new TempFileStream('tests/tmp');

        $this->assertIsString($stream->getFilePath());

        $this->assertFileExists($stream->getFilePath());
    }

    public function testCanGetContents()
    {
        $stream = new TempFileStream('tests/tmp');

        $stream->write('one,row');

        $this->assertEquals('one,row', $stream->getContents());
    }

    public function testWritesIntoFile()
    {
        $stream = new TempFileStream('tests/tmp');

        $stream->write('one,row');

        $this->assertEquals('one,row', file_get_contents($stream->getFilePath()));
    }

    public function testDeletesFileOnDestruction()
    {
        $stream = new TempFileStream('tests/tmp');

        $file_path = $stream->getFilePath();

        $this->assertFileExists($file_path);

        unset($stream);

        $this->assertFileNotExists($file_path);
    }

    public function testOnlyClosesOnce()
    {
        $stream = new TempFileStream('tests/tmp');
        $stream->open();

        // call `close()` twice and expect no error
        $stream->close();
        $stream->close();

        // unset and still expect no error
        unset($stream);
    }
}
