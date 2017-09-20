<?php
namespace Setka\WorkflowSDK\Actions;

use Psr\Http\Message\ResponseInterface;
use Setka\WorkflowSDK\API;

abstract class AbstractAction implements ActionInterface
{
    /**
     * @var API Main class to use API.
     */
    protected $api;

    /**
     * @var ResponseInterface Response after HTTP request.
     */
    protected $response;

    /**
     * @var string HTTP method (for example GET, POST, PUT...).
     */
    protected $httpMethod;

    /**
     * @var array Used to prepare request URL and request body.
     */
    protected $details;

    /**
     * Construct Action instance and setup API.
     *
     * @param API $api
     */
    public function __construct(API $api)
    {
        $this->api = $api;
        $this->lateConstruct();
    }

    /**
     * Called from construct method.
     *
     * Used to configure instance without rewriting construct method.
     */
    public function lateConstruct() {}

    /**
     * @inheritdoc
     */
    public function request()
    {
        $response = $this->getClient()->request(
            $this->getHttpMethod(),
            $this->getUrl(),
            array(
                'json' => $this->details['body'],
            )
        );

        $this->setResponse($response);

        return $this;
    }

    public function decodeResponse()
    {
        return $data = \GuzzleHttp\json_decode($this->getResponse()->getBody()->getContents());
    }

    /**
     * @inheritdoc
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @inheritdoc
     */
    public function setApi(API $api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @inheritdoc
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @inheritdoc
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @inheritdoc
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getClient()
    {
        return $this->getApi()->getClient();
    }
}
