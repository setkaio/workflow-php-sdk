<?php
namespace Setka\WorkflowSDK\Tests\Data;

/**
 * Class AbstractAssociativeDataSet
 */
class AbstractAssociativeDataSet implements \Iterator
{
    /**
     * @var array Values.
     */
    protected $variants;

    /**
     * @inheritdoc
     * @return void
     */
    public function rewind()
    {
        reset($this->variants);
    }

    /**
     * @inheritdoc
     * @return mixed Can return any type.
     */
    public function current()
    {
        return current($this->variants);
    }

    /**
     * @inheritdoc
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return key($this->variants);
    }

    /**
     * @inheritdoc
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        next($this->variants);
    }

    /**
     * @inheritdoc
     * @return boolean The return value will be casted to boolean and then evaluated.
     */
    public function valid()
    {
        return isset($this->variants[$this->key()]);
    }
}
