<?php
namespace Setka\WorkflowSDK\Tests;

use PHPUnit\Framework\TestCase;
use Setka\WorkflowSDK\AuthCredits;

/**
 * Class AuthCreditsTest
 */
class AuthCreditsTest extends TestCase
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
