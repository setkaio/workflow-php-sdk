<?php
namespace Setka\WorkflowSDK\Tests\Actions\Tickets;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Setka\WorkflowSDK\Actions\Tickets\UnpublishTicketAction;
use Setka\WorkflowSDK\API;
use Setka\WorkflowSDK\AuthCredits;
use Setka\WorkflowSDK\Tests\Data\Endpoints;
use Setka\WorkflowSDK\Tests\Data\Responses\UnpublishTicketDataSet;
use Setka\WorkflowSDK\Tests\LocalHandler;

/**
 * Class UnpublishTicketActionTest
 */
class UnpublishTicketActionTest extends TestCase
{
    /**
     * @var API
     */
    protected $api;

    /**
     * @var UnpublishTicketAction
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

        $this->stub = new UnpublishTicketAction($this->api);
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
            $this->assertEquals($responseDetails['http_body']['title'], $entity->getTitle());
            $this->assertEquals($responseDetails['http_body']['category_id'], $entity->getCategoryId());
            $this->assertEquals($responseDetails['http_body']['state'], $entity->getState());

            if ($responseDetails['http_body']['published_at']) {
                $this->assertEquals(
                    $responseDetails['http_body']['published_at'],
                    $entity->getPublishedAt()->format('Y-m-d G:i:s')
                );
            } else {
                $this->assertNull($entity->getPublishedAt());
            }

            $this->assertEquals($responseDetails['http_body']['view_post_url'], $entity->getViewPostUrl());
            $this->assertEquals($responseDetails['http_body']['edit_post_url'], $entity->getEditPostUrl());
            $this->assertEquals($responseDetails['http_body']['views_count'], $entity->getViewsCount());
            $this->assertEquals($responseDetails['http_body']['comments_count'], $entity->getCommentsCount());
        }
    }

    public function casesRequest()
    {
        return new UnpublishTicketDataSet();
    }
}
