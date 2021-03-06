<?php

namespace Okneloper\Csv;

use Okneloper\Csv\Stream\Input\InputStream;

/**
 * Class CsvReader. Reads CSV data from provided stream into a CsvRow
 * @package Okneloper\Csv
 */
class CsvReader
{
    /**
     * Map to header setting
     */
    const MAP_TO_HEADER = 1;

    /**
     * Current Line number on the Reader
     * @var int
     */
    protected $lineNr = 0;

    /**
     * Source stream of CSV data
     *
     * @var InputStream
     */
    protected $stream;

    /**
     * Property to numeric index map
     *
     * @var array
     */
    protected $map;

    /**
     * @var array|CsvRow
     */
    protected $header;


    /**
     * Get current line number
     *
     * @return int
     */
    public function getLineNr()
    {
        return $this->lineNr;
    }

    public function __construct(InputStream $stream, $hasHeader = true, $map = self::MAP_TO_HEADER)
    {
        $this->stream = $stream;

        if ($hasHeader) {
            $this->header = $this->read();
        }

        $this->map    = $map;

        if ($this->map === self::MAP_TO_HEADER) {
            if (!$hasHeader) {
                throw new \Exception("MAP_TO_HEADER is only possible when \$hasHeader is true");
            }
            $this->map = $this->header->toArray();
        }
    }

    /**
     * @return null|CsvRow
     */
    public function read()
    {
        $this->lineNr++;

        $row = $this->stream->nextLine();

        if (!$row) {
            return null;
        }

        return new CsvRow($row, $this->lineNr, $this->map);
    }

    /**
     * Rewind the underlying stream
     */
    public function rewind()
    {
        $this->stream->rewind();

        // read one line as we do in the constructor
        if ($this->header) {
            $this->header = $this->read();
        }
    }
}
