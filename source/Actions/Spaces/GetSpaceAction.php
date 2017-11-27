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
     * This method checks for status codes and try to return an Entity object
     * if request was successful (usually Response object have 200 status). But if
     * something goes wrong during request this method can thrown different exceptions.
     *
     * Each action has its own logic of this method and a different set of possible exceptions.
     *
     * @see handleResponseErrors
     *
     * @throws \Exception Different exceptions (see $this->handleResponseErrors()).
     *
     * @return SpaceEntity If response was successful.
     */
    public function handleResponse()
    {
        if (200 === $this->getResponse()->getStatusCode()) {
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
        } else {
            $this->handleResponseErrors();
        }
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
        return sprintf(Endpoints::SPACE, rawurlencode($this->getApi()->getAuth()->getToken()));
    }

    /**
     * Prepare any additional details for request.
     *
     * Calling this method is not required but by using it
     * you can be sure that you have all required data for request.
     *
     * @param array $options Your options which will be merged with defaults.
     *
     * @throws \Exception If required args is not presented in your $options or have invalid type.
     *
     * @return array Your options merged with defaults.
     */
    public function configureDetails(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(array('options'));
        $options = $resolver->resolve($options);

        $resolver = new OptionsResolver();
        // Allow any extra fields which can be added in future releases.
        $resolver->setDefined(array_keys($options['options']));
        $options['options'] = $resolver->resolve($options['options']);

        return $options;
    }
}
