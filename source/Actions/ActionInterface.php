<?php
namespace Setka\WorkflowSDK\Actions;

use Psr\Http\Message\ResponseInterface;
use Setka\WorkflowSDK\API;

/**
 * Interface ActionInterface
 */
interface ActionInterface
{
    /**
     * Makes HTTP request and saves Response object.
     *
     * @return $this For chain calls.
     */
    public function request();

    /**
     * Handles (verifies) the response object.
     *
     * @throws \Exception See Action classes to see that exceptions can be thrown.
     *
     * @return mixed Different Entities or variable types (depends on action).
     */
    public function handleResponse();

    /**
     * Returns the main API instance.
     *
     * @return API
     */
    public function getApi();

    /**
     * Setup the main API instance.
     *
     * @param API $api
     *
     * @return $this For chain calls.
     */
    public function setApi(API $api);

    /**
     * Returns HTTP Response instance.
     *
     * Available after calling request method.
     *
     * @return ResponseInterface HTTP response instance.
     */
    public function getResponse();

    /**
     * Defines HTTP Response instance.
     *
     * @param ResponseInterface $response HTTP response instance.
     *
     * @return $this For chain calls.
     */
    public function setResponse(ResponseInterface $response);

    /**
     * Returns HTTP method used to send requests.
     *
     * @return string HTTP method like 'POST' or 'GET'.
     */
    public function getHttpMethod();

    /**
     * Defines HTTP method to send requests.
     *
     * @param string $httpMethod HTTP method like 'POST' or 'GET'
     *
     * @return $this For chain calls.
     */
    public function setHttpMethod($httpMethod);

    /**
     * Returns HTTP request details.
     *
     * Used while creating URL or data in request body. See more in Action classes.
     *
     * @return array Request details.
     */
    public function getDetails();

    /**
     * Defines HTTP request details.
     *
     * Different set of parameters required for each action.
     *
     * @param array $details Request details.
     *
     * @return $this For chain calls.
     */
    public function setDetails($details);

    /**
     * Returns auto generated URL to send request.
     *
     * You need to setup $this->details before using this method.
     *
     * @return string URL which used to request.
     */
    public function getUrl();
}
