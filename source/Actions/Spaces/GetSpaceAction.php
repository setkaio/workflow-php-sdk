<?php
namespace Setka\WorkflowSDK\Actions\Spaces;

use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Setka\WorkflowSDK\Entities\SpaceEntity;
use Setka\WorkflowSDK\Exceptions\NotFoundException;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnknownResponseException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GetSpace
 */
class GetSpaceAction extends AbstractAction
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
     * @throws NotFoundException If space not found.
     * @throws UnknownResponseException If API returns unknown HTTP status code.
     *
     * @return SpaceEntity If response was successful.
     */
    public function handleResponse()
    {
        switch ($this->getResponse()->getStatusCode()) {
            case 200:
                $entity = new SpaceEntity();
                $data   = $this->decodeResponse();

                $entity
                    ->setId($data['id'])
                    ->setName($data['name'])
                    ->setShortName($data['short_name'])
                    ->setActive($data['active'])
                    ->setCreatedAt(
                        new \DateTime($data['created_at'], new \DateTimeZone('UTC'))
                    )
                    ->setUpdatedAt(
                        new \DateTime($data['updated_at'], new \DateTimeZone('UTC'))
                    );

                return $entity;

            case 401:
                throw new UnauthorizedException();

            case 404:
                throw new NotFoundException();

            default:
                throw new UnknownResponseException();
        }//end switch
    }

    /**
     * @inheritdoc
     */
    public function lateConstruct()
    {
        $this->setHttpMethod('GET');
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return Endpoints::CATEGORY;
    }

    public function configureDetails(array $options)
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired(array('body'));

        $options = $resolver->resolve($options);

        $resolver = new OptionsResolver();

        // Allow any extra fields which can be added in future releases.
        $resolver->setDefined(array_keys($options['body']));

        // Token for authorization.
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());

        $options['body'] = $resolver->resolve($options['body']);

        return $options;
    }
}
