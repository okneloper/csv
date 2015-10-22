<?php

namespace Okneloper\Csv;

/**
 * Class CsvRow. Represants a row of CSV data
 * @package Okneloper\Csv
 * @author Aleksey Lavrinenko
 */
class CsvRow implements \ArrayAccess
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var int
     */
    protected $lineNr;

    /**
     * @return int
     */
    public function getLineNr()
    {
        return $this->lineNr;
    }

    /**
     * Magic getter for the underlying array
     * @param $prop
     * @return mixed
     */
    public function __get($prop)
    {
        if (!array_key_exists($prop, $this->data)) {
            throw new \BadMethodCallException("[$prop] is not defined");
        }
        return $this->data[$prop];
    }

    public function __construct($data, $lineNr, $map = null)
    {
        $this->lineNr = $lineNr;

        if (!$map) {
            $this->data = $data;
        } else {
            $this->data = [];
            foreach ($map as $key => $assoc) {
                $this->data[ $assoc ] = $data[$key];
            }
        }
    }

    /**
     * Return an array presentation fo the row
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException;
    }
}
