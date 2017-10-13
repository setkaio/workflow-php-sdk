<?php
namespace Setka\WorkflowSDK\Actions\Tickets;

use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Setka\WorkflowSDK\Entities\TicketEntity;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnknownResponseException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SyncTicketAnalyticsAction
 */
class SyncTicketAnalyticsAction extends AbstractAction
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
     * @throws UnprocessableEntityException If something your your request was wrong (or ticket already published).
     * @throws UnknownResponseException If API returns unknown HTTP status code.
     *
     * @return TicketEntity[] If response was successful.
     */
    public function handleResponse()
    {
        switch ($this->getResponse()->getStatusCode()) {
            case 200:
                $data     = $this->decodeResponse();
                $entities = array();

                foreach ($data as $a) {
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
            Endpoints::TICKETS_SYNC_ANALYTICS,
            rawurlencode($this->details['space'])
        );
    }

    public function configureDetails(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(array('space', 'options'));
        $options = $resolver->resolve($options);


        $resolver = new OptionsResolver();
        $resolver->setRequired('json');
        // Allow any extra fields which can be added in future releases.
        $resolver->setDefined(array_keys($options['options']));
        $options['options'] = $resolver->resolve($options['options']);


        // Allow default fields.
        $resolver = new OptionsResolver();
        // Token for authorization.
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());
        $resolver->setRequired('tickets');
        $resolver->setAllowedTypes('tickets', 'array');
        // Allow any extra fields which can be added in future releases.
        $resolver->setDefined(array_keys($options['options']['json']));
        $options['options']['json'] = $resolver->resolve($options['options']['json']);

        return $options;
    }
}
