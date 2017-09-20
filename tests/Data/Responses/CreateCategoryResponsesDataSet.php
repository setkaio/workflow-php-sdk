<?php
namespace Setka\WorkflowSDK\Tests\Data\Responses;

use Setka\WorkflowSDK\Tests\Data\AbstractAssociativeDataSet;

class CreateCategoryResponsesDataSet extends AbstractAssociativeDataSet
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
            ),
        );

        $variants['2.3'] = array(
            array(
                'space' => 'test-space',
                'name'  => 'Test Name',
            ),
            array(
                'http_code' => 401,
                'http_body' => array(),
            ),
        );

        $variants['2.4'] = array(
            array(
                'space' => 'test-space',
                'token' => null,
                'name'  => 'Test Name',
            ),
            array(
                'http_code' => 401,
                'http_body' => array(),
            ),
        );

        $variants['2.5'] = array(
            array(
                'space' => 'test-space',
                'token' => 123,
                'name'  => 'Test Name',
            ),
            array(
                'http_code' => 401,
                'http_body' => array(),
            ),
        );

        $this->variants = $variants;
    }
}
