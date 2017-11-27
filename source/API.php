<?php
namespace Setka\WorkflowSDK;

use GuzzleHttp\ClientInterface;

/**
 * Class API
 */
class API
{
    /**
     * @var AuthCredits Request access details.
     */
    protected $auth;

    /**
     * @var ClientInterface Client which sends HTTP requests.
     */
    protected $client;

    /**
     * Returns instance with access details.
     *
     * @return AuthCredits Instance with access details.
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Setup instance with access details.
     *
     * @param AuthCredits $auth Access credentials.
     *
     * @return $this For chain calls.
     */
    public function setAuth(AuthCredits $auth)
    {
        $this->auth = $auth;
        return $this;
    }

    /**
     * Returns Client instance which is used to send HTTP requests.
     *
     * @return ClientInterface Guzzle client.
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Setup Client instance which is used to send HTTP requests.
     *
     * @param ClientInterface $client Guzzle client.
     *
     * @return $this For chain calls.
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
        return $this;
    }
}
