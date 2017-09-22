<?php
namespace Setka\WorkflowSDK\Tests\Data\Responses;

use Setka\WorkflowSDK\Entities\TicketEntity;
use Setka\WorkflowSDK\Tests\Data\AbstractAssociativeDataSet;

/**
 * Class PublishTicketDataSet
 */
class PublishTicketDataSet extends AbstractAssociativeDataSet
{
    /**
     * PublishTicketDataSet constructor.
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
                    'state' => 'published',
                    'published_at' => '2017-09-04 10:00:00',
                    'view_post_url' => 'https://test-site.com/111/',
                    'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                    'views_count' => 100,
                    'comments_count' => 2,
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
                    'state' => 'published',
                    'published_at' => '2017-09-04 10:00:00',
                    'view_post_url' => 'https://test-site.com/111/',
                    'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                    'views_count' => null,
                    'comments_count' => null,
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
                    'state' => 'published',
                    'published_at' => '2017-09-04 10:00:00',
                    'view_post_url' => 'https://test-site.com/111/',
                    'edit_post_url' => 'https://test-site.com/admin/edit-post/111/',
                    'views_count' => null,
                    'comments_count' => null,
                ),
                'handle_expect' => TicketEntity::class,
            ),
        );

        $variants['1.3'] = array(
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

        $this->variants = $variants;
    }
}
