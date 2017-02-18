<?php

namespace Okneloper\Csv\Stream\Input;

use Okneloper\Csv\CsvRow;

/**
 * Interface Stream
 * @package Okneloper\Csv\Stream
 */
interface InputStream
{
    /**
     * Return next line of CSV data or false if there is no more data
     * @return array|null
     */
    public function nextLine();

    /**
     * Rewind the stream
     *
     * @return void
     */
    public function rewind();
}
