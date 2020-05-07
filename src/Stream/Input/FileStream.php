<?php

namespace Okneloper\Csv\Stream\Input;

use Okneloper\Csv\Stream\StreamException;

/**
 * Class FileStream. Uses a file as source for CSV data.
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
            throw new FileNotFoundException("File [$filePath] does not exist");
        }

        $this->handle = fopen($filePath, 'r');

        if (!$this->handle) {
            throw new StreamException("Could not open file [$filePath] for reading");
        }
    }
}
