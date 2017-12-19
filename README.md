# Setka Workflow PHP SDK

Библиотека создана для упрощения взаимодействия с Workflow API. Например, вы сможете обновлять информацию о тикетах и управлять категориями.

В качестве прослойки для отправки запросов используется [Guzzle](https://github.com/guzzle/guzzle). Благодаря этому вы сможете использовать любой клиент для отправки запросов, например, cURL или Stream, или [создать любой другой клиент](http://docs.guzzlephp.org/en/stable/handlers-and-middleware.html#creating-a-handler).

## Начало работы

Для начала работы необходимо установить библиотеку в вашем проекте с помощью Composer. К сожалению, в настоящее время данная библиотека еще не зарегистрирована на сайте packagist.org, поэтому перед запуском `composer require` необходимо указать поле `repositories` внутри вашего `composer.json` файла.

1. Откройте ваш файл `composer.json` и добавьте несколько строчек конфигурации `repositories`.

```json
"repositories": [
  {
    "type": "git",
    "url": "https://github.com/setkaio/workflow-php-sdk.git"
  }
]
```

2. Выполните команду `composer require` из папки вашего проекта.

```bash
composer require setka/workflow-php-sdk
```

### Что нужно для начала работы с Workflow API?

После подключения библиотеки все что необходимо для отправки запросов это API License key. Его можно найти в настройках вашего аккаунта.

1. Зайдите в свой аккаунт на сайте [workflow.setka.io](https://workflow.setka.io/).
2. Перейдите в Settings (в правом верхнем углу).
3. В меню слева перейдите в раздел Custom CMS (на этой странице можно увидеть API License key или сбросить его).

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

// If no exception was thrown then request was successful and you can use $entity object.
```

## Contributing

To run PHP Code Sniffer run the following commands.

```bash
composer install
vendor/bin/phpcs --standard=phpcs.ruleset.xml
```