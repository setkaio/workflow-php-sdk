<?php
namespace Setka\WorkflowSDK\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

/**
 * Class LocalHandler
 */
class LocalHandler
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * @param RequestInterface $request HTTP Request instance.
     * @param array            $options Additional options with request.
     *
     * @return Response HTTP Response instance.
     */
    public function __invoke(RequestInterface $request, array $options)
    {
        return $this->getResponse();
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response HTTP Response instance.
     *
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }
}
