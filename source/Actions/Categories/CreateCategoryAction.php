<?php
namespace Setka\WorkflowSDK\Actions\Categories;

use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCategoryAction extends AbstractAction
{
    /**
     * @inheritdoc
     */
    public function lateConstruct()
    {
        $this->setHttpMethod('POST');
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return sprintf(Endpoints::CATEGORIES, rawurlencode($this->details['space']));
    }

    public function configureDetails(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(array('space', 'body'));

        $options = $resolver->resolve($options);

        $resolver = new OptionsResolver();
        $resolver->setRequired('name');
        $resolver->setDefault('token', $this->getApi()->getAuth()->getToken());

        $options['body'] = $resolver->resolve($options['body']);

        return $options;
    }
}
