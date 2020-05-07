<?php

use Okneloper\Csv\CsvReader;
use PHPUnit\Framework\TestCase;

class CsvReaderTest extends TestCase
{
    public function testCanMapsHeaderAutomatically()
    {
        $csv = new CsvReader($this->input());

        $row = $csv->read();

        $this->assertEquals(['position', 'animal', 'weight'], array_keys($row->toArray()));
    }

    public function testCanMapsHeaderManually()
    {
        $csv = new CsvReader($this->input(), true, ['p', 'a', 'w']);

        $row = $csv->read();

        $this->assertEquals(['p', 'a', 'w'], array_keys($row->toArray()));
    }

    public function testCanReadWithoutHeader()
    {
        $csv = new CsvReader($this->input(), false, ['col1', 'col2', 'col3']);

        $row = $csv->read();

        $this->assertEquals([
            'col1' => 'position',
            'col2' => 'animal',
            'col3' => 'weight'
        ], $row->toArray());
    }

    private function input(): \Okneloper\Csv\Stream\Input\InputStream
    {
        return new \Okneloper\Csv\Stream\Input\FileStream(__DIR__ . '/fixtures/input.csv');
    }
}
