<?php
namespace Setka\WorkflowSDK\Tests\Data\Responses;

use Setka\WorkflowSDK\Entities\CategoryEntity;
use Setka\WorkflowSDK\Exceptions\ServerException;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Setka\WorkflowSDK\Tests\Data\AbstractAssociativeDataSet;

/**
 * Class CreateCategoryDataSet
 */
class CreateCategoryDataSet extends AbstractAssociativeDataSet
{
    /**
     * CreateCategoryDataSet constructor.
     */
    public function __construct()
    {
        $variants = array();

        $variants['1.'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'name'  => 'Test Name',
                    ),
                ),
            ),
            array(
                'http_code' => 200,
                'http_body' => array(
                    'id' => '123456',
                    'name' => 'Test Name',
                ),
                'handle_expect' => CategoryEntity::class,
            ),
        );

        $variants['2.'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'name'  => '',
                    ),
                ),
            ),
            array(
                'http_code' => 422,
                'http_body' => array(
                    'message' => 'name must be filled',
                ),
                'handle_expect' => UnprocessableEntityException::class,
            ),
        );

        $variants['2.1'] = array(
            array(
                'space' => '',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'name'  => 'Test Name',
                    ),
                ),
            ),
            array(
                'http_code' => 422,
                'http_body' => array(
                    'message' => 'space must be filled',
                ),
                'handle_expect' => UnprocessableEntityException::class,
            ),
        );

        $variants['2.2'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => '',
                        'name'  => 'Test Name',
                    ),
                ),
            ),
            array(
                'http_code' => 401,
                'http_body' => array(),
                'handle_expect' => UnauthorizedException::class,
            ),
        );

        $variants['2.3'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => null,
                        'name'  => 'Test Name',
                    ),
                ),
            ),
            array(
                'http_code' => 401,
                'http_body' => array(),
                'handle_expect' => UnauthorizedException::class,
            ),
        );

        $variants['2.4'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 123,
                        'name'  => 'Test Name',
                    ),
                ),
            ),
            array(
                'http_code' => 401,
                'http_body' => array(),
                'handle_expect' => UnauthorizedException::class,
            ),
        );

        $variants['3.'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'name'  => 'Test Name',
                    ),
                ),
            ),
            array(
                'http_code' => 502,
                'http_body' => array(),
                'handle_expect' => ServerException::class,
            ),
        );

        $variants['3.1'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'name'  => 'Test Name',
                    ),
                ),
            ),
            array(
                'http_code' => 503,
                'http_body' => array(),
                'handle_expect' => ServerException::class,
            ),
        );

        $variants['3.2'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'name'  => 'Test Name',
                    ),
                ),
            ),
            array(
                'http_code' => 504,
                'http_body' => array(),
                'handle_expect' => ServerException::class,
            ),
        );

        $this->variants = $variants;
    }
}
