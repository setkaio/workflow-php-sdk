<?php
namespace Setka\WorkflowSDK\Actions\Categories;

use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeleteCategoryAction extends AbstractAction
{
    public function lateConstruct()
    {
        $this->setHttpMethod('DELETE');
    }

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
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());

        $options['body'] = $resolver->resolve($options['body']);

        return $options;
    }
}
