<?php
namespace Setka\WorkflowSDK\Tests\Actions\Spaces;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Setka\WorkflowSDK\Actions\Spaces\GetSpaceAction;
use Setka\WorkflowSDK\API;
use Setka\WorkflowSDK\AuthCredits;
use Setka\WorkflowSDK\Tests\Data\Endpoints;
use Setka\WorkflowSDK\Tests\Data\Responses\GetSpaceDataSet;
use Setka\WorkflowSDK\Tests\LocalHandler;

/**
 * Class GetSpaceTest
 */
class GetSpaceActionTest extends TestCase
{
    /**
     * @var API
     */
    protected $api;

    /**
     * @var GetSpaceAction
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

        $this->stub = new GetSpaceAction($this->api);
    }

    /**
     * @dataProvider casesRequest
     *
     * @param $requestDetails array
     * @param $responseDetails array
     */
    public function testRequest($requestDetails, $responseDetails)
    {
        $this->api->getAuth()->setToken($requestDetails['options']['json']['token']);

        // Prepare action.
        $details = $this->stub->configureDetails($requestDetails);

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

        $this->assertInstanceOf($responseDetails['handle_expect'], $entity);

        if (!is_a($entity, \Exception::class)) {
            $this->assertEquals($responseDetails['http_body']['id'], $entity->getId());
            $this->assertEquals($responseDetails['http_body']['name'], $entity->getName());
            $this->assertEquals($responseDetails['http_body']['short_name'], $entity->getShortName());
            $this->assertEquals($responseDetails['http_body']['active'], $entity->isActive());
            $this->assertEquals(
                $responseDetails['http_body']['created_at'],
                $entity->getCreatedAt()->format('Y-m-d G:i:s')
            );
            $this->assertEquals(
                $responseDetails['http_body']['updated_at'],
                $entity->getUpdatedAt()->format('Y-m-d G:i:s')
            );
        }
    }

    public function casesRequest()
    {
        return new GetSpaceDataSet();
    }
}
