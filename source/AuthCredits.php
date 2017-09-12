<?php
namespace Setka\WorkflowSDK;

class AuthCredits
{
    /**
     * @var string
     */
    protected $token;

    /**
     * AuthCredits constructor.
     *
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
}
