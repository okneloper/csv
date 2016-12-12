<?php

namespace Okneloper\Csv;

/**
 * Class CsvWriter
 * @package Okneloper\Csv
 */
class CsvWriter
{
    protected $filepath;
    protected $is_temp = false;
    protected $handle;

    /**
     * @return null|string
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    public function __construct($filepath = null)
    {
        if (!$filepath) {
            $filepath = tempnam('/tmp', 'csv_writer_');
            $this->is_temp = true;
        }

        $this->filepath = $filepath;

        $this->open();
    }

    public function open()
    {
        $this->handle = fopen($this->filepath, 'w');

        if (!$this->handle) {
            throw new \Exception("Unable to open file {$this->filepath} for writing");
        }
    }

    /**
     * @param array|CsvRow $row
     */
    public function write($row)
    {
        if ($row instanceof CsvRow) {
            $row = array_values($row->toArray());
        }
        fputcsv($this->handle, $row);
    }

    public function done()
    {
        fclose($this->handle);
    }

    public function __destruct()
    {
        if ($this->is_temp && file_exists($this->filepath)) {
            unlink($this->filepath);
        }
    }
}
