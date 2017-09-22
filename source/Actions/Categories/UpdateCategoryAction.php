<?php
namespace Setka\WorkflowSDK\Actions\Categories;

use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Setka\WorkflowSDK\Entities\CategoryEntity;
use Setka\WorkflowSDK\Exceptions\NotFoundException;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnknownResponseException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UpdateCategoryAction
 */
class UpdateCategoryAction extends AbstractAction
{
    /**
     * Handle response.
     *
     * Actually this method check for status codes and try to return an Entity object
     * if request was successful (usually Response object have 200 status). But if
     * something goes wrong during request this method can throws different exceptions.
     *
     * Each action have their own logic of this method and different set of possible exceptions.
     *
     * @throws UnauthorizedException If token missed or invalid.
     * @throws NotFoundException If category not found.
     * @throws UnprocessableEntityException If something your your request was wrong.
     * @throws UnknownResponseException If API returns unknown HTTP status code.
     *
     * @return CategoryEntity If response was successful.
     */
    public function handleResponse()
    {
        switch ($this->getResponse()->getStatusCode()) {
            case 200:
                $entity = new CategoryEntity();
                $data   = $this->decodeResponse();
                $entity
                    ->setId($data['id'])
                    ->setName($data['name']);

                return $entity;

            case 401:
                throw new UnauthorizedException();

            case 404:
                throw new NotFoundException();

            case 422:
                $data = $this->decodeResponse();
                throw new UnprocessableEntityException($data['message']);

            default:
                throw new UnknownResponseException();
        }//end switch
    }

    /**
     * @inheritdoc
     */
    public function lateConstruct()
    {
        $this->setHttpMethod('PATH');
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return sprintf(
            Endpoints::CATEGORY,
            rawurlencode($this->details['space']),
            rawurlencode($this->details['id'])
        );
    }

    public function configureDetails(array $options)
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired(array('space', 'id', 'body'));

        $options = $resolver->resolve($options);

        $resolver = new OptionsResolver();

        // Allow default category fields.
        $resolver->setRequired('name');

        // Allow any extra fields which can be added in future releases.
        $resolver->setDefined(array_keys($options['body']));

        // Token for authorization.
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());

        $options['body'] = $resolver->resolve($options['body']);

        return $options;
    }
}
