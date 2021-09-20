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
        if (!$this->isOpen()) {
            return;
        }
        fclose($this->handle);
    }

    protected function ensureHandleIsOpen()
    {
        // open the stream automatically
        if (!$this->isOpen()) {
            $this->open();
        }
    }

    /**
     * Returns true if the stream has a valid resource to write to
     * @return bool
     */
    private function isOpen(): bool
    {
        return is_resource($this->handle) && get_resource_type($this->handle) === 'stream';
    }
}
