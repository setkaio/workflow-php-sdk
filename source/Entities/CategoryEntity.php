<?php
namespace Setka\WorkflowSDK\Entities;

/**
 * Class CategoryEntity
 */
class CategoryEntity extends AbstractEntity
{
    /**
     * @var string Name of category.
     */
    protected $name;

    /**
     * CategoryEntity constructor.
     *
     * @param string $id
     * @param string $name
     */
    public function __construct($id = null, $name = null)
    {
        $this->id   = $id;
        $this->name = $name;
    }


    /**
     * Returns the name of category.
     *
     * @return string Name of category.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setup name of category.
     *
     * @param string $name Name of category.
     * @return $this For chain calls.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
