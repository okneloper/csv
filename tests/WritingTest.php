<?php

abstract class WritingTest extends \PHPUnit\Framework\TestCase
{
    protected $dataAsArray =  [
        ['test1', 'test2'],
        ['test3', 'test4'],
    ];

    protected $dataAsString = "test1,test2\ntest3,test4\n";
}
