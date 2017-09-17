<?php
namespace Setka\WorkflowSDK\Tests;

use PHPUnit\Framework\TestCase;
use Setka\WorkflowSDK\Actions\Categories\CreateCategoryAction;
use Setka\WorkflowSDK\API;
use Setka\WorkflowSDK\AuthCredits;
use Setka\WorkflowSDK\ClientFactory;

class CreateCategoryActionTest extends TestCase
{
    /**
     * @var API
     */
    protected $api;

    /**
     * @var CreateCategoryAction
     */
    protected $stub;

    public function setUp()
    {
        $this->api = new API();
        $this->api->setAuth(new AuthCredits('a98fc7fc7640fb86d848358223cc422b98e2eb3385107b80eb'));
        $this->api->setClient(ClientFactory::create());
        $this->stub = new CreateCategoryAction($this->api);
    }

    public function testRequest()
    {
        $this->stub->setDetails(array(
            'space' => 'gg',
            'body' => array(
                'name' => 'TEST NAME',
            ),
        ));

        $this->stub->request();
        var_dump($this->stub->getResponse());
    }
}
