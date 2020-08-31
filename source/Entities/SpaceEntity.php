<?php
namespace Setka\WorkflowSDK\Entities;

/**
 * Class SpaceEntity
 */
class SpaceEntity extends AbstractEntity
{
    /**
     * @var string The name of space in human readable format.
     */
    protected $name;

    /**
     * @var string The short name of space (used in URLs) (also can be named as slug).
     */
    protected $shortName;

    /**
     * @var boolean Space state.
     */
    protected $active;

    /**
     * @var \DateTime Space created date as \DateTime object (UTC).
     */
    protected $createdAt;

    /**
     * @var \DateTime Space updated date as \DateTime object (UTC).
     */
    protected $updatedAt;

    /**
     * SpaceEntity constructor.
     *
     * @param int $id Space ID.
     * @param string $name Space name.
     * @param string $shortName Space short name (slug).
     * @param bool $active Space state.
     * @param \DateTime $createdAt Space created time.
     * @param \DateTime $updatedAt Space last modified time.
     */
    public function __construct(
        $id = null,
        $name = null,
        $shortName = null,
        $active = null,
        \DateTime $createdAt = null,
        \DateTime $updatedAt = null
    ) {
        $this->id        = $id;
        $this->name      = $name;
        $this->shortName = $shortName;
        $this->active    = $active;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }


    /**
     * Return name of space.
     *
     * @return string Space name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setups name of space.
     *
     * @param string $name Space name
     *
     * @return $this For chain calls.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns space short name.
     *
     * @return string Space short name
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Setups space short name.
     *
     * @param string $shortName Space short name.
     *
     * @return $this For chain calls.
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
        return $this;
    }

    /**
     * Returns state of space.
     *
     * @return bool Space state.
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Setups state of space.
     *
     * @param bool $active Space state.
     *
     * @return $this For chain calls.
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Returns space created time.
     *
     * @return \DateTime Space created time.
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Setups space created time.
     *
     * @param \DateTime $createdAt Space created time.
     *
     * @return $this For chain calls.
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Returns space updated time.
     *
     * @return \DateTime Space last updated time.
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Setups space updated time.
     *
     * @param \DateTime $updatedAt Space last updated time.
     *
     * @return $this For chain calls.
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
