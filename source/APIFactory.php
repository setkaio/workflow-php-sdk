<?php
namespace Setka\WorkflowSDK;

use GuzzleHttp\ClientInterface;

class APIFactory
{
    /**
     * @param $token string API Token.
     * @param $client ClientInterface Guzzle client which make requests.
     *
     * @return API
     */
    public static function create($token = null, ClientInterface $client = null)
    {
        $api = new API();

        if($token)
            $api->setAuth(new AuthCredits($token));

        if(!$client)
            $client = ClientFactory::create();

        $api->setClient($client);

        return $api;
    }
}
