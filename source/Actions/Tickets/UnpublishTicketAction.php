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

class UnpublishTicketAction extends AbstractAction
{
    /**
     * Handle response.
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
        switch($this->getResponse()->getStatusCode()) {
            case 200:
                $entity = new TicketEntity();
                $data = $this->decodeResponse();
                $entity
                    ->setId($data['id'])
                    ->setTitle($data['title'])
                    ->setCategoryId($data['category_id'])
                    ->setState($data['state'])
                    ->setPublishedAt($data['published_at'])
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
        }
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
            Endpoints::TICKETS_UNPUBLISH,
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
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());

        $options['body'] = $resolver->resolve($options['body']);

        return $options;
    }
}
