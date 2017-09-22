# Setka Workflow PHP SDK

This library can be used to easily send the requests to Setka Workflow API.

## How to use it

Simple example which shows how you can use this library.

```php
use Setka\WorkflowSDK\APIFactory;
use Setka\WorkflowSDK\Actions\Categories\CreateCategoryAction;

try {
  // Creating the main API instance.
  $api = APIFactory::create('YOUR_TOKEN');
  
  // Creating action for creating category.
  $action = new CreateCategoryAction($api);

  // Configure action.
  $details = $action->configureDetails(array(
    'space' => 'your-space-slug',
    'body' => array(
      'name' => 'Name for category',
    ),
  ));

  $entity = $action
    ->setDetails($details)
    ->request()
    ->handleResponse();
  } catch (\Exception $exception) {
    // Error
  }
}

// If no exception was throwed then request was successful and you can use $entity object.
```