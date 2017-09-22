<?php
namespace Setka\WorkflowSDK\Entities;

/**
 * Class AbstractEntity
 */
abstract class AbstractEntity implements EntityInterface
{
    /**
     * @var string Unique ID of entity from Setka API.
     */
    protected $id;

    /**
     * Returns the ID of entity.
     *
     * @return string ID of entity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setup ID of entity.
     *
     * @param string $id Unique ID.
     * @return $this For chain calls.
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
