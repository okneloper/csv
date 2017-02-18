<?php

namespace Okneloper\Csv\Stream\Input;

/**
 * Class FileStream. Uses a file as source for CSV data.
 *
 * @package Okneloper\Csv\Stream
 * @author Aleksey Lavrinenko
 */
class FileStream extends HandleStream
{
    /**
     * @param string $filePath Path to a CSV file
     * @throws StreamException
     * @throws \Exception
     */
    public function __construct($filePath)
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File [$filePath] does not exist");
        }

        $this->handle = fopen($filePath, 'r');
        if (!$this->handle) {
            throw new StreamException("Could not  file [$filePath] for reading");
        }
    }
}
