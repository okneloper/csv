<?php

namespace Okneloper\Csv\Stream\Input;

/**
 * Class HandleStream. Reads CSV data from a php file handle using fgetcsv
 *
 * @package Okneloper\Csv\Stream
 */
abstract class HandleStream implements InputStream
{
    /**
     * Set PHP ini value auto_detect_line_endings
     *
     * @param int $value
     */
    public static function setAutoDetectLineEndings($value = 1)
    {
        ini_set('auto_detect_line_endings', $value);
    }

    /**
     * File handle
     * @var resource
     */
    protected $handle;

    /**
     * CSV delimiter
     * @var string
     */
    public $delimiter;

    /**
     * Length of line to read
     * @var int
     */
    public $lineLength = 0;

    /**
     * @return resource
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @see StreamInterface::nextLine()
     * @return array
     */
    public function nextLine()
    {
        if ($this->delimiter) {
            $row = fgetcsv($this->handle, $this->lineLength, $this->delimiter);
        } else {
            $row = fgetcsv($this->handle, $this->lineLength);
        }
        return $row;
    }

    public function rewind()
    {
        rewind($this->handle);
    }
}
