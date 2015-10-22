<?php

namespace Okneloper\Csv;

use Okneloper\Csv\Stream\StreamInterface;

/**
 * Class CsvReader. Reads CSV data from provided stream into a CsvRow
 * @package Okneloper\Csv
 * @author Aleksey Lavrinenko
 */
class CsvReader
{
    const MAP_TO_HEADER = 1;

    protected $lineNr = 0;

    /**
     * @var StreamInterface
     */
    protected $stream;

    protected $map;

    /**
     * @var array|CsvRow
     */
    protected $header;


    /**
     * @return int
     */
    public function getLineNr()
    {
        return $this->lineNr;
    }

    public function __construct(StreamInterface $stream, $hasHeader = true, $map = self::MAP_TO_HEADER)
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

    public function read()
    {
        $this->lineNr++;

        $row = $this->stream->nextLine();

        if (!$row) {
            return $row;
        }

        return new CsvRow($row, $this->lineNr, $this->map);
    }
}
