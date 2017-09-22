<?php
namespace Setka\WorkflowSDK\Tests;

use GuzzleHttp\Client;
use Setka\WorkflowSDK\API;
use Setka\WorkflowSDK\APIFactory;
use Setka\WorkflowSDK\AuthCredits;
use Setka\WorkflowSDK\ClientFactory;

class APIFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = APIFactory::create('TOKEN');
        $this->assertTrue(is_a($a, API::class));
        $this->assertTrue(is_a($a->getAuth(), AuthCredits::class));
        $this->assertTrue(is_a($a->getClient(), Client::class));

        $a = APIFactory::create('TOKEN', ClientFactory::create());
        $this->assertTrue(is_a($a, API::class));
        $this->assertTrue(is_a($a->getAuth(), AuthCredits::class));
        $this->assertTrue(is_a($a->getClient(), Client::class));
    }
}
