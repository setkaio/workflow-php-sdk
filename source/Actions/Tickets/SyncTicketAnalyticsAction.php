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
        } else {
            $this->handleResponseErrors();
        }
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
            Endpoints::TICKETS_SYNC_ANALYTICS,
            rawurlencode($this->details['space'])
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
