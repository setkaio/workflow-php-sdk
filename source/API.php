<?php
namespace Setka\WorkflowSDK;

use GuzzleHttp\ClientInterface;

class API
{
    /**
     * @var AuthCredits
     */
    protected $auth;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @return AuthCredits
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param AuthCredits $auth
     *
     * @return $this
     */
    public function setAuth(AuthCredits $auth)
    {
        $this->auth = $auth;
        return $this;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     *
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
        return $this;
    }
}
