# Setka Workflow PHP SDK

The library is developed to simplify your interaction with Workflow API. With Workflow API, you can update ticket information and manage post categories.

[Guzzle](https://github.com/guzzle/guzzle) is used to send HTTP requests. You can use any available handler with Guzzle, including cURL, Stream, etc., or [create your own](http://docs.guzzlephp.org/en/stable/handlers-and-middleware.html#creating-a-handler).

## Basics

To start, install the library into your project using Composer Dependency Manager (the library is not yet registered at packagist.org, but we’re working on it!). In order to execute `composer require` you have to:

1. Open the `composer.json` file and specify the `repository` field and the following information:

    ```json
    "repositories": [
      {
        "type": "git",
        "url": "https://github.com/setkaio/workflow-php-sdk.git"
      }
    ]
    ```

2. Execute the `composer require` command from your project directory.

    ```bash
    composer require setka/workflow-php-sdk
    ```

### How do I start working with Workflow API?

An API license key is required for sending requests. Copy your API License Key from "Account Settings":

1. Log in your Workflow account [workflow.setka.io](https://workflow.setka.io/).
2. Go "Settings" at the right hand upper corner.
3. Click "Custom CMS" and copy an API license key.

## Sending your First Request to Setka Workflow API

First, initialize these objects to send requests:

* `Setka\WorkflowSDK\API` — a main object for API interaction.
    * `GuzzleHttp\Client` — sends HTTP-requests using the chosen Handler.
    * `Setka\WorkflowSDK\AuthCredits` — stores data required for Workflow API authentication (API license token).
* `Setka\WorkflowSDK\Actions\ActionInterface` — any class with this interface is set for sending appropriate requests to the API.

```php
use Setka\WorkflowSDK\APIFactory;
use Setka\WorkflowSDK\Actions\Spaces\GetSpaceAction;

try {
  // Use APIFactory for quick usage or to create manually.
  $api = APIFactory::create('YOUR_TOKEN');
  
  // Create an Action to obtain data.
  $action = new GetSpaceAction($api);

  // Prevent generating Guzzle exceptions.
  $details = $action->configureDetails(array(
    'options' => array(
      'http_errors' => false,
    ),
  ));

  $entity = $action
    // Save settings and parameters
    ->setDetails($details)
    // Perform a request
    ->request()
    // Handling response to requests (each Action has its own handleResponse method)
    ->handleResponse();
    
  // If no exception is thrown, your request was successful.
  // You can then move on to use $entity object (Setka\WorkflowSDK\Entities\SpaceEntity).
    
  $shortName = $entity->getShortName();
  $name      = $entity->getName();
} catch (\Exception $exception) {
    // Error
}
```

## Creating a Category

Once you’ve performed your first request, you can save "Space Short Name" as a parameter for sending future requests. "Space Short Name" is used almost in all requests so we recommend that you cache the "GetSpaceAction" response for better performance.

```php
try {
  $api = APIFactory::create('YOUR_TOKEN');
  
  // Creating an action to set up a category
  $action = new CreateCategoryAction($api);

  // Configuring an action
  $details = $action->configureDetails(array(
    // Use a value from a previous request
    'space' => 'your-space-short-name',
    'options' => array(
      // Disable exceptions in Guzzle
      'http_errors' => false,
      'json' => array(
        'name' => 'Your name for category',
      ),
    ),
  ));

  $entity = $action
    ->setDetails($details)
    ->request()
    ->handleResponse();
    
  // Category sucessfylly created!
  // Using $entity instance in your code    
} catch (\Exception $exception) {
  // Error
}
```

## Contributing

To run PHP Code Sniffer run the following commands.

```bash
composer install
vendor/bin/phpcs --standard=phpcs.ruleset.xml
```