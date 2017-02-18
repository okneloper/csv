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
     * @return mixed
     */
    public function write(CsvRow $row)
    {
        // open the stream automatically
        if (!is_resource($this->handle)) {
            $this->open();
            #throw new StreamException("File handle not available. Have you called stream::open()?");
        }

        fputcsv($this->handle, array_values($row->toArray()));
        $this->rowsWritten++;
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
     * @return mixed
     */
    public function close()
    {
        fclose($this->handle);
    }
}
