<?php
namespace Setka\WorkflowSDK\Tests;

use Setka\WorkflowSDK\AuthCredits;

class AuthCreditsTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $a = new AuthCredits('TOKEN');
        $this->assertTrue(is_a($a, AuthCredits::class));
        $this->assertEquals('TOKEN', $a->getToken());
    }
}
