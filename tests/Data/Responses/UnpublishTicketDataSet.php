<?php
namespace Setka\WorkflowSDK\Tests\Data\Responses;

use Setka\WorkflowSDK\Entities\TicketEntity;
use Setka\WorkflowSDK\Exceptions\NotFoundException;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Setka\WorkflowSDK\Tests\Data\AbstractAssociativeDataSet;

/**
 * Class UnpublishTicketDataSet
 */
class UnpublishTicketDataSet extends AbstractAssociativeDataSet
{
    /**
     * UnpublishTicketDataSet constructor.
     */
    public function __construct()
    {
        $variants = array();

        $variants['1.'] = array(
            array(
                'space' => 'test-space',
                'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                'id'  => '123456',
            ),
            array(
                'http_code' => 200,
                'http_body' => array(
                    'id' => '123456',
                    'title' => 'Test Title',
                    'category_id' => '78910',
                    'state' => 'assigned',
                    'published_at' => null,
                    'view_post_url' => 'https://test-site.com/111/',
                    'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                    'views_count' => 0,
                    'comments_count' => 0,
                ),
                'handle_expect' => TicketEntity::class,
            ),
        );

        $variants['1.1'] = array(
            array(
                'space' => 'test-space',
                'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                'id'  => '123456',
            ),
            array(
                'http_code' => 200,
                'http_body' => array(
                    'id' => '123456',
                    'title' => 'Test Title',
                    'category_id' => '78910',
                    'state' => 'assigned',
                    'published_at' => null,
                    'view_post_url' => 'https://test-site.com/111/',
                    'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                    'views_count' => 0,
                    'comments_count' => 0,
                ),
                'handle_expect' => TicketEntity::class,
            ),
        );

        $variants['1.2'] = array(
            array(
                'space' => 'test-space',
                'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                'id'  => '123456',
            ),
            array(
                'http_code' => 200,
                'http_body' => array(
                    'id' => '123456',
                    'title' => 'Test Title',
                    'category_id' => 78910,
                    'state' => 'assigned',
                    'published_at' => null,
                    'view_post_url' => 'https://test-site.com/111/',
                    'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                    'views_count' => null,
                    'comments_count' => null,
                ),
                'handle_expect' => TicketEntity::class,
            ),
        );

        $variants['2.'] = array(
            array(
                'space' => 'test-space',
                'token' => '',
                'id'  => '123456',
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
                'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                'id'  => 'NOT_EXISTS_ID',
            ),
            array(
                'http_code' => 404,
                'http_body' => array(),
                'handle_expect' => NotFoundException::class,
            ),
        );

        $variants['4.'] = array(
            array(
                'space' => 'test-space',
                'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                'id'  => '123456',
            ),
            array(
                'http_code' => 422,
                'http_body' => array(
                    'message' => 'Ticket is not published',
                ),
                'handle_expect' => UnprocessableEntityException::class,
            ),
        );

        $this->variants = $variants;
    }
}
