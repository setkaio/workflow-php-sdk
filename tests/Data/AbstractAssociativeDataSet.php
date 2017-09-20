<?php
namespace Setka\WorkflowSDK\Tests\Data;

class AbstractAssociativeDataSet implements \Iterator {

    /**
     * @var array Values.
     */
    protected $variants;

    public function rewind() {
        reset($this->variants);
    }

    public function current() {
        return current($this->variants);
    }

    public function key() {
        return key($this->variants);
    }

    public function next() {
        next($this->variants);
    }

    public function valid() {
        return isset($this->variants[$this->key()]);
    }
}
