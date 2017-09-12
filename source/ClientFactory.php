<?php
namespace Setka\WorkflowSDK;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class ClientFactory
{
    /**
     * @return ClientInterface
     */
    public static function create()
    {
        return new Client(array(
            'base_uri' => Endpoints::API,
        ));
    }
}
