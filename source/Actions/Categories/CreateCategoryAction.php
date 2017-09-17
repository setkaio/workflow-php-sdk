<?php
namespace Setka\WorkflowSDK\Actions\Categories;

use GuzzleHttp\Client;
use Setka\WorkflowSDK\Actions\AbstractAction;
use Setka\WorkflowSDK\Endpoints;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCategoryAction extends AbstractAction
{
    public function request()
    {
        /*$client = $this->getClient();
        $client->post()*/
        $response = $this->getClient()->request('POST', $this->getUrl(), array(
            'json' => $this->details,
        ));

        $this->setResponse($response);

        return $this;
    }

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
