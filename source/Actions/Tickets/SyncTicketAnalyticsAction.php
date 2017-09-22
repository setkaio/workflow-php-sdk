<?php
namespace Setka\WorkflowSDK\Actions\Tickets;

use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Setka\WorkflowSDK\Entities\TicketEntity;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnknownResponseException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SyncTicketAnalyticsAction extends AbstractAction
{
    /**
     * Handle response.
     *
     * @throws UnauthorizedException If token missed or invalid.
     * @throws UnprocessableEntityException If something your your request was wrong (or ticket already published).
     * @throws UnknownResponseException If API returns unknown HTTP status code.
     *
     * @return TicketEntity[] If response was successful.
     */
    public function handleResponse()
    {
        switch($this->getResponse()->getStatusCode()) {
            case 200:
                $data = $this->decodeResponse();
                $entities = array();

                foreach($data as $a)
                {
                    $b = new TicketEntity();
                    $b
                        ->setId($a['id'])
                        ->setViewPostUrl($a['view_post_url'])
                        ->setViewsCount($a['views_count'])
                        ->setCommentsCount($a['comments_count']);

                    $entities[] = $b;
                }

                return $entities;

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
        $this->setHttpMethod('PATH');
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return sprintf(
            Endpoints::TICKETS_SYNC_ANALYTICS,
            rawurlencode($this->details['space'])
        );
    }

    public function configureDetails(array $options)
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired(array('space', 'body'));

        $options = $resolver->resolve($options);

        $resolver = new OptionsResolver();

        // Allow default fields.
        $resolver->setRequired('tickets');
        $resolver->setAllowedTypes('tickets', 'array');

        // Allow any extra fields which can be added in future releases.
        $resolver->setDefined(array_keys($options['body']));

        // Token for authorization.
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());

        $options['body'] = $resolver->resolve($options['body']);

        return $options;
    }
}
