<?php

namespace Okneloper\Csv\Stream\Output;

use Okneloper\Csv\CsvRow;
use Okneloper\Csv\Stream\StreamException;

abstract class HandleStream implements OutputStream
{
    /**
     * @var resource
     */
    protected $handle;

    protected $rowsWritten = 0;

    /**
     * Writes a CsvRow into the stream
     * @param CsvRow $row
     * @return void
     */
    public function writeRow(CsvRow $row)
    {
        $this->ensureHandleIsOpen();

        fputcsv($this->handle, array_values($row->toArray()));
        $this->rowsWritten++;
    }

    /**
     * Write Arbitrary data
     * @param $data
     * @return void
     */
    public function write($data)
    {
        $this->ensureHandleIsOpen();

        fwrite($this->handle, $data);
    }

    /**
     * Returns number of lines written
     * @return int
     */
    public function rowsWritten()
    {
        return $this->rowsWritten;
    }

    /**
     * Close the stream
     * @return void
     */
    public function close()
    {
        fclose($this->handle);
    }

    protected function ensureHandleIsOpen()
    {
        // open the stream automatically
        if (!is_resource($this->handle)) {
            $this->open();
            #throw new StreamException("File handle not available. Have you called stream::open()?");
        }
    }
}
