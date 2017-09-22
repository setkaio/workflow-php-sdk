<?php
namespace Setka\WorkflowSDK\Tests;

use GuzzleHttp\Client;
use Setka\WorkflowSDK\ClientFactory;

class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = ClientFactory::create();
        $this->assertTrue(is_a($a, Client::class));
    }
}
