<?php
namespace Setka\WorkflowSDK;

use GuzzleHttp\ClientInterface;

/**
 * Class APIFactory
 */
class APIFactory
{
    /**
     * Creates API instance.
     *
     * It's a helper method so you can create API instance manually.
     *
     * @param $token string API Token.
     * @param $client ClientInterface Guzzle client which make requests.
     *
     * @return API Your well configured instance.
     */
    public static function create($token, ClientInterface $client = null)
    {
        $api = new API();

        $api->setAuth(new AuthCredits($token));

        if (!$client) {
            $client = ClientFactory::create();
        }

        $api->setClient($client);

        return $api;
    }
}
