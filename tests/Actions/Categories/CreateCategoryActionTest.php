<?php
namespace Setka\WorkflowSDK\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Setka\WorkflowSDK\Actions\Categories\CreateCategoryAction;
use Setka\WorkflowSDK\API;
use Setka\WorkflowSDK\AuthCredits;
use Setka\WorkflowSDK\Tests\Data\Endpoints;
use Setka\WorkflowSDK\Tests\Data\Responses\CreateCategoryDataSet;

/**
 * Class CreateCategoryActionTest
 */
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

    /**
     * @var LocalHandler
     */
    protected $handler;

    public function setUp()
    {
        $this->api = new API();
        $this->api->setAuth(new AuthCredits(''));

        $this->handler = new LocalHandler();

        $client = new Client(array(
            'base_uri' => Endpoints::TEST_API,
            'handler' => $this->handler,
        ));

        $this->api->setClient($client);

        $this->stub = new CreateCategoryAction($this->api);
    }

    /**
     * @dataProvider casesRequest
     *
     * @param $requestDetails array
     * @param $responseDetails array
     */
    public function testRequest($requestDetails, $responseDetails)
    {
        $this->api->getAuth()->setToken($requestDetails['token']);

        // Prepare action.
        $details = $this->stub->configureDetails(array(
            'space' => $requestDetails['space'],
            'body' => array(
                'name' => $requestDetails['name'],
            ),
        ));

        // Prepare response.
        $response = new Response(
            $responseDetails['http_code'],
            array(),
            \GuzzleHttp\json_encode($responseDetails['http_body'])
        );
        $this->handler->setResponse($response);

        // Save details and make request.
        try {
            $entity = $this->stub
                ->setDetails($details)
                ->request()
                ->handleResponse();
        } catch (\Exception $exception) {
            $entity = $exception;
        }

        $this->assertTrue(is_a($entity, $responseDetails['handle_expect']));

        if (!is_a($entity, \Exception::class)) {
            $this->assertEquals($responseDetails['http_body']['id'], $entity->getId());
            $this->assertEquals($responseDetails['http_body']['name'], $entity->getName());
        }
    }

    public function casesRequest()
    {
        return new CreateCategoryDataSet();
    }
}
