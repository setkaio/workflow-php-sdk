<?php
namespace Setka\WorkflowSDK\Actions\Tickets;

use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Setka\WorkflowSDK\Entities\TicketEntity;
use Setka\WorkflowSDK\Exceptions\NotFoundException;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnknownResponseException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PublishTicketAction
 */
class PublishTicketAction extends AbstractAction
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
     * @return TicketEntity If response was successful.
     */
    public function handleResponse()
    {
        if (200 === $this->getResponse()->getStatusCode()) {
            $entity = new TicketEntity();
            $data   = $this->decodeResponse();
            $entity
                ->setId($data['id'])
                ->setTitle($data['title'])
                ->setCategoryId($data['category_id'])
                ->setState($data['state'])
                ->setPublishedAt(
                    new \DateTime(
                        $data['published_at'],
                        new \DateTimeZone('UTC')
                    )
                )
                ->setViewPostUrl($data['view_post_url'])
                ->setEditPostUrl($data['edit_post_url'])
                ->setViewsCount($data['views_count'])
                ->setCommentsCount($data['comments_count']);

            return $entity;
        } else {
            $this->handleResponseErrors();
        }//end if
    }

    /**
     * @inheritdoc
     */
    public function lateConstruct()
    {
        $this->setHttpMethod('PATCH');
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return sprintf(
            Endpoints::TICKETS_PUBLISH,
            rawurlencode($this->details['space']),
            rawurlencode($this->details['id'])
        );
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
        $resolver->setRequired(array('space', 'id', 'options'));
        $options = $resolver->resolve($options);


        $resolver = new OptionsResolver();
        $resolver->setRequired('json');
        // Allow any extra fields which can be added in future releases.
        $resolver->setDefined(array_keys($options['options']));
        $options['options'] = $resolver->resolve($options['options']);


        $resolver = new OptionsResolver();
        // Token for authorization.
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());
        // Allow any extra fields which can be added in future releases.
        $resolver->setDefined(array_keys($options['options']['json']));
        $options['options']['json'] = $resolver->resolve($options['options']['json']);

        return $options;
    }
}
