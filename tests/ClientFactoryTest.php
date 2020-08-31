<?php
namespace Setka\WorkflowSDK\Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Setka\WorkflowSDK\ClientFactory;

/**
 * Class ClientFactoryTest
 */
class ClientFactoryTest extends TestCase
{
    /**
     * Test creating method.
     *
     * @return void
     */
    public function testCreate()
    {
        $a = ClientFactory::create();
        $this->assertInstanceOf(Client::class, $a);
    }
}
