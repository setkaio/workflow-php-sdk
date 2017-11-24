<?php
namespace Setka\WorkflowSDK\Tests;

use Setka\WorkflowSDK\AuthCredits;

/**
 * Class AuthCreditsTest
 */
class AuthCreditsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test constructor.
     * @return void
     */
    public function testConstruct()
    {
        $a = new AuthCredits('TOKEN');
        $this->assertTrue(is_a($a, AuthCredits::class));
        $this->assertEquals('TOKEN', $a->getToken());
    }
}
