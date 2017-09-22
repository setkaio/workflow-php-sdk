<?php
namespace Setka\WorkflowSDK;

/**
 * Class AuthCredits
 */
class AuthCredits
{
    /**
     * @var string Access token.
     */
    protected $token;

    /**
     * AuthCredits constructor.
     *
     * @param string $token Access token from Setka API.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Returns access token.
     *
     * @return string Access token.
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Setup access token.
     *
     * @param string $token Access token.
     *
     * @return $this For chain calls.
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
}
