<?php

namespace Okneloper\Csv;

use Okneloper\Csv\Stream\Output\OutputStream;

/**
 * Class CsvWriter
 * @package Okneloper\Csv
 */
class CsvWriter
{
    protected $filepath;
    protected $is_temp = false;

    /**
     * Output stream
     * @var OutputStream
     */
    protected $stream;

    /**
     * @return null|string
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    public function __construct(OutputStream $stream)
    {
        $this->stream = $stream;
    }

    /**
     * @param array|CsvRow $row
     */
    public function write($row)
    {
        if (!($row instanceof CsvRow)) {
            $row = new CsvRow($row, $this->stream->rowsWritten() + 1);
        }
        $this->stream->writeRow($row);
    }

    public function done()
    {
        $this->stream->close();
    }

    /**
     * Writes UTF-8 Byte Order Mark into the stream. This should be written to the file beginning,
     * so should be done before anything is written
     */
    public function writeUtf8Bom()
    {
        $this->stream->write("\xEF\xBB\xBF");
    }

    /*
    public function __destruct()
    {
        $this->done();
    }
    */
}
