<?php
namespace Setka\WorkflowSDK;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class ClientFactory
 */
class ClientFactory
{
    /**
     * Helper method for creating Guzzle client.
     *
     * It's also defines base_uri. You can create Client instance manually.
     *
     * @return ClientInterface Your client instance configured with base URL.
     */
    public static function create()
    {
        return new Client(array(
            'base_uri' => Endpoints::API,
        ));
    }
}
