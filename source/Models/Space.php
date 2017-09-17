<?php
namespace Setka\WorkflowSDK\Models;

use Setka\WorkflowSDK\API;

class Space implements ModelInterface
{
    /**
     * @var API Workflow API
     */
    protected $api;

    /**
     * @var string A space short name.
     */
    protected $slug;

    /**
     * Space constructor.
     *
     * @param API $api
     * @param string $slug
     */
    public function __construct(API $api, $slug)
    {
        $this->api = $api;
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return $this For chain calls.
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
}
