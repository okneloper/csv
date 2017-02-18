<?php

namespace Okneloper\Csv\Stream\Output;

use Okneloper\Csv\Stream\StreamException;

/**
 * Class TempFileStream
 * Automatically creates and destroys a temp file and uses it as the destination
 * @package Okneloper\Csv\Stream\Output
 */
class TempFileStream extends HandleStream
{
    protected $tempFile;

    public function __construct($dir = '/tmp', $prefix = 'csv_')
    {
        $this->tempFile = tempnam($dir, $prefix);

        if (!$this->tempFile) {
            throw new StreamException("Could not create a temporary file");
        }

        $handle = fopen($this->tempFile, 'w');

        parent::__construct($handle);
    }

    public function __destruct()
    {
        if (file_exists($this->tempFile)) {
            unlink($this->tempFile);
        }
    }

    public function getContents()
    {
        return file_get_contents($this->tempFile);
    }

    public function getFilePath()
    {
        return $this->tempFile;
    }
}
