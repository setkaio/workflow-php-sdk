<?php
namespace Setka\WorkflowSDK\Actions\Tickets;

use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateTicketAction extends AbstractAction
{
    public function lateConstruct()
    {
        $this->setHttpMethod('PATH');
    }

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
        $resolver->setRequired(array('space', 'id', 'body'));

        $options = $resolver->resolve($options);

        $resolver = new OptionsResolver();
        $resolver->setDefined(array('title', 'state', 'category_id', 'published_at', 'view_post_url', 'edit_post_url', 'views_count', 'comments_count'));
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());

        $options['body'] = $resolver->resolve($options['body']);

        return $options;
    }
}
