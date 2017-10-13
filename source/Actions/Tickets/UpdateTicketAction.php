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
 * Class UpdateTicketAction
 */
class UpdateTicketAction extends AbstractAction
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
     * @throws NotFoundException If ticket not found.
     * @throws UnprocessableEntityException If something your your request was wrong (or ticket already published).
     * @throws UnknownResponseException If API returns unknown HTTP status code.
     *
     * @return TicketEntity If response was successful.
     */
    public function handleResponse()
    {
        switch ($this->getResponse()->getStatusCode()) {
            case 200:
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
            Endpoints::TICKET,
            rawurlencode($this->details['space']),
            rawurlencode($this->details['id'])
        );
    }

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
        // Allow default ticket fields.
        $resolver->setDefined(array(
            'title',
            'state',
            'category_id',
            'published_at',
            'view_post_url',
            'edit_post_url',
            'views_count',
            'comments_count',
        ));
        // Allow any extra fields which can be added in future releases.
        $resolver->setDefined(array_keys($options['options']['json']));
        $options['options']['json'] = $resolver->resolve($options['options']['json']);

        return $options;
    }
}
