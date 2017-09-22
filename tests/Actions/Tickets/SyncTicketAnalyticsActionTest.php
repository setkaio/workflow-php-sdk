<?php
namespace Setka\WorkflowSDK\Tests\Actions\Tickets;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Setka\WorkflowSDK\Actions\Tickets\SyncTicketAnalyticsAction;
use Setka\WorkflowSDK\API;
use Setka\WorkflowSDK\AuthCredits;
use Setka\WorkflowSDK\Tests\Data\Endpoints;
use Setka\WorkflowSDK\Tests\Data\Responses\SyncTicketAnalyticsDataSet;
use Setka\WorkflowSDK\Tests\LocalHandler;

class SyncTicketAnalyticsActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var API
     */
    protected $api;

    /**
     * @var SyncTicketAnalyticsAction
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

        $this->stub = new SyncTicketAnalyticsAction($this->api);
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

        // Prepare action
        $details = $this->stub->configureDetails(array(
            'space' => $requestDetails['space'],
            'body' => array(
                'tickets' => $requestDetails['tickets']
            ),
        ));

        // Prepare response
        $response = new Response(
            $responseDetails['http_code'],
            array(),
            \GuzzleHttp\json_encode($responseDetails['http_body'])
        );
        $this->handler->setResponse($response);

        // Save details and make request
        try {
            $entities = $this->stub
                ->setDetails($details)
                ->request()
                ->handleResponse();
        } catch (\Exception $exception) {
            $entities = $exception;
        }

        if (is_a($entities, \Exception::class)) {
            $this->assertTrue(is_a($entities, $responseDetails['handle_expect']));
        } else {
            $this->assertTrue(is_array($entities));
            $this->assertNotEmpty($entities);

            foreach ($entities as $entityKey => $entityValue) {
                $this->assertTrue(is_a($entityValue, $responseDetails['handle_expect']));

                $this->assertEquals(
                    $responseDetails['http_body'][$entityKey]['id'],
                    $entityValue->getId()
                );
                $this->assertEquals(
                    $responseDetails['http_body'][$entityKey]['views_count'],
                    $entityValue->getViewsCount()
                );
                $this->assertEquals(
                    $responseDetails['http_body'][$entityKey]['comments_count'],
                    $entityValue->getCommentsCount()
                );
            }
        }
    }

    public function casesRequest()
    {
        return new SyncTicketAnalyticsDataSet();
    }
}
