<?php
namespace Setka\WorkflowSDK\Actions;

use Psr\Http\Message\ResponseInterface;
use Setka\WorkflowSDK\API;
use Setka\WorkflowSDK\Exceptions\NotFoundException;
use Setka\WorkflowSDK\Exceptions\ServerException;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnknownResponseException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;

/**
 * Class AbstractAction
 */
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
    public function lateConstruct()
    {
    }

    /**
     * @inheritdoc
     */
    public function request()
    {
        $response = $this->getClient()->request(
            $this->getHttpMethod(),
            $this->getUrl(),
            $this->details['options']
        );

        $this->setResponse($response);

        return $this;
    }

    /**
     * Handle response status codes which indicates errors.
     *
     * @throws UnauthorizedException If token missed or invalid
     * @throws NotFoundException If requested resource not found.
     * @throws ServerException Server side error.
     * @throws UnprocessableEntityException If something your your request was wrong.
     * @throws UnknownResponseException If API returns unknown HTTP status code.
     */
    public function handleResponseErrors()
    {
        switch ($this->getResponse()->getStatusCode()) {
            case 401:
                throw new UnauthorizedException();

            case 404:
                throw new NotFoundException();

            case 422:
                $data = $this->decodeResponse();
                throw new UnprocessableEntityException($data['message']);

            case 502:
            case 503:
            case 504:
                throw new ServerException();

            default:
                throw new UnknownResponseException();
        }
    }

    public function decodeResponse()
    {
        return $data = \GuzzleHttp\json_decode($this->getResponse()->getBody()->getContents(), true);
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
