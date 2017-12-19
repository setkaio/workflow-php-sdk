# Setka Workflow PHP SDK

Библиотека создана для упрощения взаимодействия с Workflow API. Например, вы сможете обновлять информацию о тикетах и управлять категориями.

В качестве прослойки для отправки запросов используется [Guzzle](https://github.com/guzzle/guzzle). Благодаря этому вы сможете использовать любой клиент для отправки запросов, например, cURL или Stream, или [создать свой собственный клиент](http://docs.guzzlephp.org/en/stable/handlers-and-middleware.html#creating-a-handler).

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
3. В меню слева перейдите в раздел Custom CMS (на этой странице можно увидеть API License key или изменить его).

## Ваш первый запрос в Setka Workflow API

Для отправки запросов необходимо инициализировать несколько объектов.

* `Setka\WorkflowSDK\API` — главный объект для общения с API.
    * `GuzzleHttp\Client` — отправляет HTTP запросы с помощью выбранного Handler.
    * `Setka\WorkflowSDK\AuthCredits` — хранит в себе данные для авторизации в Workflow API (API license token).
* `Setka\WorkflowSDK\Actions\ActionInterface` — любой из классов имеющий этот интерфейс создан и настроен для отправки необходимого запроса в API.

```php
use Setka\WorkflowSDK\APIFactory;
use Setka\WorkflowSDK\Actions\Spaces\GetSpaceAction;

try {
  // Вы можете использовать фабрику для быстрого использования.
  // Или самостоятельно создавать все необходимые объекты.
  $api = APIFactory::create('YOUR_TOKEN');
  
  // Создаем Action для получения необходимой информации.
  $action = new GetSpaceAction($api);

  // Если вы хотите отключить выбрасывание исключений внутри Guzzle.
  $details = $action->configureDetails(array(
    'options' => array(
      'http_errors' => false,
    ),
  ));

  $entity = $action
    // Сохраняем настройки и параметры
    ->setDetails($details)
    // Делаем запрос
    ->request()
    // Обрабатываем запрос (каждый Action имеет свою собственную функцию handleResponse).
    ->handleResponse();
    
  // If no exception was thrown then request was successful and you can use $entity object (Setka\WorkflowSDK\Entities\SpaceEntity).
    
  $shortName = $entity->getShortName();
  $name      = $entity->getName();
} catch (\Exception $exception) {
    // Error
}
```

## Создаем категорию

После того как вы сделали свой первый запрос, о котором рассказывалось выше, вы можете сохранить Space Short Name, т. к. этот параметр используется для отправки остальных запросов. Это значение, как правило, неизменно для компании, поэтому для экономии времени и лучшей производительности лучше сохранить его локально.

В примере ниже мы создадим новую категорию в Setka Workflow, указав произвольное имя. Похожим образом вы можете работать и с другими сущностями Setka Workflow.

```php
try {
  $api = APIFactory::create('YOUR_TOKEN');
  
  // Creating action for creating category.
  $action = new CreateCategoryAction($api);

  // Configure action.
  $details = $action->configureDetails(array(
    // You can get this value from previous request example
    'space' => 'your-space-slug',
    'options' => array(
      // Выключение выброса ошибок от Guzzle.
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
  
  // You can use $entity instance in your code.    
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