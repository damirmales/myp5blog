<?php
namespace Services;

use Exception;
use IteratorAggregate;
use Traversable;

class Collection implements IteratorAggregate, \ArrayAccess
{
    private $items; //tableau reçu

    public function __construct(array $items)
    {
        $this->items = $items;

    }

    public function arrayAssoc($key, $value)
    {
        foreach ($key as $value)
        {
            return $value;
        }
    }

    /***********************
     * Méthodes de la classe ArrayAccess *****************
        /**
     *
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return $this->hasKey($offset);
    }

    public function hasKey($key)
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->getKey($offset);
    }

    public function getKey($key)
    {

        if ($this->hasKey($key)) {//echo "<pre> hasKey Collection $key=>"; var_dump($this->items[$key]);
            return $this->items[$key];
        }
        else
        {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        return $this->setKey($offset);
    }

    public  function setKey($key, $value)
    {
        $this->items[$key] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        if ($this->hasKey($offset)) {
            unset($this->items[$offset]);
        }
    }
    /***********************
     * 
     * Méthode de la classe IteratorAggregate *****************
    /**
     *
     * @inheritDoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
