<?php
namespace Setka\WorkflowSDK\Actions;

use Psr\Http\Message\ResponseInterface;
use Setka\WorkflowSDK\API;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractAction implements ActionInterface
{
    /**
     * @var API
     */
    protected $api;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var string
     */
    protected $httpMethod;

    /**
     * @var array
     */
    protected $details;

    /**
     * @var OptionsResolver
     */
    protected $detailsResolver;

    /**
     * AbstractAction constructor.
     *
     * @param API $api
     */
    public function __construct(API $api)
    {
        $this->api = $api;
        $this->lateConstruct();
    }

    public function lateConstruct()
    {
    }

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

    /**
     * @return API
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param API $api
     *
     * @return $this
     */
    public function setApi(API $api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return $this
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @param string $httpMethod
     *
     * @return $this
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
        return $this;
    }

    /**
     * @return array
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param array $details
     *
     * @return $this
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return OptionsResolver
     */
    public function getDetailsResolver()
    {
        return $this->detailsResolver;
    }

    /**
     * @param OptionsResolver $detailsResolver
     *
     * @return $this
     */
    public function setDetailsResolver(OptionsResolver $detailsResolver)
    {
        $this->detailsResolver = $detailsResolver;

        return $this;
    }

    public function getClient()
    {
        return $this->getApi()->getClient();
    }
}
