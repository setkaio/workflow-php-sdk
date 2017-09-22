<?php
namespace Setka\WorkflowSDK\Tests;

use GuzzleHttp\Client;
use Setka\WorkflowSDK\ClientFactory;

/**
 * Class ClientFactoryTest
 */
class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test creating method.
     *
     * @return void
     */
    public function testCreate()
    {
        $a = ClientFactory::create();
        $this->assertTrue(is_a($a, Client::class));
    }
}
