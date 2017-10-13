<?php
namespace Setka\WorkflowSDK\Tests\Data\Responses;

use Setka\WorkflowSDK\Entities\SpaceEntity;
use Setka\WorkflowSDK\Exceptions\NotFoundException;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnknownResponseException;
use Setka\WorkflowSDK\Tests\Data\AbstractAssociativeDataSet;

/**
 * Class GetSpaceDataSet
 */
class GetSpaceDataSet extends AbstractAssociativeDataSet
{
    /**
     * GetSpaceDataSet constructor.
     */
    public function __construct()
    {
        $variants = array();

        $variants['1.'] = array(
            array(
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                    ),
                ),
            ),
            array(
                'http_code' => 200,
                'http_body' => array(
                    'id' => '123456',
                    'name' => 'Test Name',
                    'short_name' => 'test-name',
                    'active' => true,
                    'created_at' => '2017-10-12 17:20:14',
                    'updated_at' => '2017-10-12 17:21:14',
                ),
                'handle_expect' => SpaceEntity::class,
            ),
        );

        $variants['2.'] = array(
            array(
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
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
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                    ),
                ),
            ),
            array(
                'http_code' => 404,
                'http_body' => array(),
                'handle_expect' => NotFoundException::class,
            ),
        );

        $variants['4.'] = array(
            array(
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                    ),
                ),
            ),
            array(
                'http_code' => 500,
                'http_body' => array(),
                'handle_expect' => UnknownResponseException::class,
            ),
        );

        $this->variants = $variants;
    }
}
