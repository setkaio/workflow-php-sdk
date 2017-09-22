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
     * @inheritDoc
     */
    public function rewind()
    {
        reset($this->variants);
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return current($this->variants);
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return key($this->variants);
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        next($this->variants);
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        return isset($this->variants[$this->key()]);
    }
}
