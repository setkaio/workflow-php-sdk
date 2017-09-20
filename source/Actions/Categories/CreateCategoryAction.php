<?php
namespace Setka\WorkflowSDK\Actions\Categories;

use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Setka\WorkflowSDK\Entities\CategoryEntity;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnknownResponseException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCategoryAction extends AbstractAction
{
    /**
     * Handle response.
     *
     * @throws UnauthorizedException If token missed or invalid.
     * @throws UnprocessableEntityException If something your your request was wrong.
     * @throws UnknownResponseException If API returns unknown HTTP status code.
     *
     * @return CategoryEntity If response was successful.
     */
    public function handleResponse()
    {
        switch($this->getResponse()->getStatusCode()) {
            case 200:
                $entity = new CategoryEntity();
                $data = $this->decodeResponse();
                $entity
                    ->setId($data['id'])
                    ->setName($data['name']);

                return $entity;

            case 401:
                throw new UnauthorizedException();

            case 422:
                $data = $this->decodeResponse();
                throw new UnprocessableEntityException($data['message']);

            default:
                throw new UnknownResponseException();
        }
    }

    /**
     * @inheritdoc
     */
    public function lateConstruct()
    {
        $this->setHttpMethod('POST');
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return sprintf(Endpoints::CATEGORIES, rawurlencode($this->details['space']));
    }

    public function configureDetails(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(array('space', 'body'));

        $options = $resolver->resolve($options);

        $resolver = new OptionsResolver();
        $resolver->setRequired('name');
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());

        $options['body'] = $resolver->resolve($options['body']);

        return $options;
    }
}
