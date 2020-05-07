<?php

use Okneloper\Csv\Stream\Input\StringStream;
use PHPUnit\Framework\TestCase;

class StringInputStreamTest extends TestCase
{
    public function testItWorks()
    {
        $string = 'gravity,falls';

        $stream = new StringStream($string);

        $this->assertEquals(['gravity', 'falls'], $stream->nextLine());
    }
}
