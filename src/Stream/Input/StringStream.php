<?php

namespace Okneloper\Csv\Stream\Input;

/**
 * Class StringStream. Uses a string as source for CSV data
 * @package Mtc\Csv\Stream
 * @author Aleksey Lavrinenko
 */
class StringStream extends HandleStream
{
    /**
     * @param $csvString String containing CSV data
     */
    public function __construct($csvString)
    {
        $handle = fopen('php://memory', 'w+');
        fwrite($handle, $csvString);
        rewind($handle);
        $this->handle = $handle;
    }
}
