<?php

use Okneloper\Csv\Stream\Input\FileStream;
use PHPUnit\Framework\TestCase;

class FileInputStreamTest extends TestCase
{
    public function testItWorks()
    {
        $stream = new FileStream(__DIR__ . '/fixtures/input.csv');

        $this->assertEquals(['position', 'animal', 'weight'], $stream->nextLine());

        $this->assertEquals(['1', 'Blue whale', '180 tonnes'], $stream->nextLine());
    }

    public function testItCanRewind()
    {
        $stream = new FileStream(__DIR__ . '/fixtures/input.csv');

        $this->assertEquals(['position', 'animal', 'weight'], $stream->nextLine());

        $stream->rewind();

        $this->assertEquals(['position', 'animal', 'weight'], $stream->nextLine());
    }

    public function testThrowsExceptionWhenFileNotFound()
    {
        $this->expectException(\Okneloper\Csv\Stream\Input\FileNotFoundException::class);

        new FileStream(__DIR__ . '/fixtures/input.csv-not-found');
    }

    public function testCanGetHandle()
    {
        $stream = new FileStream(__DIR__ . '/fixtures/input.csv');

        $this->assertIsResource($stream->getHandle());
    }
}
