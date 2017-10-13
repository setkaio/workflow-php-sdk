<?php
namespace Setka\WorkflowSDK\Tests\Data\Responses;

use Setka\WorkflowSDK\Entities\CategoryEntity;
use Setka\WorkflowSDK\Entities\TicketEntity;
use Setka\WorkflowSDK\Exceptions\NotFoundException;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Setka\WorkflowSDK\Tests\Data\AbstractAssociativeDataSet;

/**
 * Class UpdateTicketDataSet
 */
class UpdateTicketDataSet extends AbstractAssociativeDataSet
{
    /**
     * UpdateTicketDataSet constructor.
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

                        'id' => '123456',
                        'title' => 'Test Title',
                        'category_id' => '123',
                        'state' => 'published',
                        'published_at' => '2017-09-04 10:00:00',
                        'view_post_url' => 'https://test-site.com/111/',
                        'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                        'views_count' => '100',
                        'comments_count' => '2',
                    ),
                ),
            ),
            array(
                'http_code' => 200,
                'http_body' => array(
                    'id' => '123456',
                    'title' => 'Test Title',
                    'category_id' => '123',
                    'state' => 'published',
                    'published_at' => '2017-09-04 10:00:00',
                    'view_post_url' => 'https://test-site.com/111/',
                    'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                    'views_count' => '100',
                    'comments_count' => '2',
                ),
                'handle_expect' => TicketEntity::class,
            ),
        );

        $variants['2.'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => '',

                        'id' => '123456',
                        'title' => 'Test Title',
                        'category_id' => '123',
                        'state' => 'published',
                        'published_at' => '2017-09-04 10:00:00',
                        'view_post_url' => 'https://test-site.com/111/',
                        'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                        'views_count' => '100',
                        'comments_count' => '2',
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

                        'id' => '123456',
                        'title' => 'Test Title',
                        'category_id' => '123',
                        'state' => 'published',
                        'published_at' => '2017-09-04 10:00:00',
                        'view_post_url' => 'https://test-site.com/111/',
                        'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                        'views_count' => '100',
                        'comments_count' => '2',
                    ),
                ),
            ),
            array(
                'http_code' => 404,
                'http_body' => array(),
                'handle_expect' => NotFoundException::class,
            ),
        );

        $variants['5.'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',

                        'id' => '123456',
                        'title' => 'Test Title',
                        'category_id' => '123',
                        'state' => 'published',
                        'published_at' => 'INVALID DATETIME',
                        'view_post_url' => 'https://test-site.com/111/',
                        'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                        'views_count' => '100',
                        'comments_count' => '2',
                    ),
                ),
            ),
            array(
                'http_code' => 422,
                'http_body' => array(
                    'message' => 'date format is invalid',
                ),
                'handle_expect' => UnprocessableEntityException::class,
            ),
        );

        $this->variants = $variants;
    }
}
