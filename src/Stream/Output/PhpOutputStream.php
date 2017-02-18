<?php

namespace Okneloper\Csv\Stream\Output;

class PhpOutputStream extends HandleStream
{
    /**
     * Open stream for writing
     * @return void
     */
    public function open()
    {
        $this->handle = fopen('php://output', 'w');
    }
}
