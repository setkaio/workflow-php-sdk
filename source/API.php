<?php
namespace Setka\WorkflowSDK;

use GuzzleHttp\ClientInterface;
use Setka\WorkflowSDK\Models\Space;

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

    /**
     * @param $shortName string
     *
     * @return Space
     */
    public function getSpace($shortName)
    {
        return new Space($this, $shortName);
    }

    /*public function createCategory($name)
    {
        $url = sprintf(Endpoints::CATEGORIES, $this->getSpace()->getSlug());

        return $this->getClient()->request('POST', $url, array(
            'json' => array(
                'name' => $name,
            ),
        ));
    }*/
}
