<?php

namespace Okneloper\Csv\Stream;

/**
 * Interface StreamInterface
 * @package Okneloper\Csv\Stream
 */
interface StreamInterface
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
