<?php

namespace Okneloper\Csv\Stream\Output;

use Okneloper\Csv\CsvRow;

/**
 * Interface OutputStream
 * Writes CSV data
 * @package Okneloper\Csv\Stream
 */
interface OutputStream
{
    /**
     * Open stream for writing
     * @return void
     */
    public function open();

    /**
     * Close the stream
     * @return void
     */
    public function close();

    /**
     * Writes a CcvRow into the stream
     * @param CsvRow $row
     * @return void
     */
    public function writeRow(CsvRow $row);

    /**
     * Write Arbitrary data
     * @param $data
     * @return void
     */
    public function write($data);

    /**
     * Returns number of lines written
     * @return int
     */
    public function rowsWritten();
}
