<?php
namespace Setka\WorkflowSDK\Tests\Data\Responses;

use Setka\WorkflowSDK\Entities\CategoryEntity;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Setka\WorkflowSDK\Tests\Data\AbstractAssociativeDataSet;

class UpdateCategoryResponsesDataSet extends AbstractAssociativeDataSet
{
    public function __construct()
    {
        $variants = array();

        $variants['1.'] = array(
            array(
                'space' => 'test-space',
                'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                'name'  => 'Test Name',
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
                'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                'name'  => '',
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
                'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                'name'  => 'Test Name',
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
                'token' => '',
                'name'  => 'Test Name',
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
                'token' => null,
                'name'  => 'Test Name',
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
                'token' => 123,
                'name'  => 'Test Name',
            ),
            array(
                'http_code' => 401,
                'http_body' => array(),
                'handle_expect' => UnauthorizedException::class,
            ),
        );

        $this->variants = $variants;
    }
}
