<?php
namespace Setka\WorkflowSDK\Tests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class LocalHandler
{
    /**
     * @var Response
     */
    protected $response;

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
     * @param Response $response
     *
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }
}
