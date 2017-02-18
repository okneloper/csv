<?php

namespace Okneloper\Csv\Stream\Output;

class FileStream extends HandleStream
{
    /**
     * Path to file we are writing to
     * @var string
     */
    protected $file;

    public function __construct($filePath)
    {
        $this->file = $filePath;
    }

    /**
     * Open stream for writing
     * @return void
     */
    public function open()
    {
        $this->handle = fopen($this->file, 'w');
    }
}
