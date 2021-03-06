<?php
namespace Setka\WorkflowSDK\Tests\Data\Responses;

use Setka\WorkflowSDK\Entities\TicketEntity;
use Setka\WorkflowSDK\Exceptions\ServerException;
use Setka\WorkflowSDK\Exceptions\UnauthorizedException;
use Setka\WorkflowSDK\Exceptions\UnprocessableEntityException;
use Setka\WorkflowSDK\Tests\Data\AbstractAssociativeDataSet;

/**
 * Class SyncTicketAnalyticsDataSet
 */
class SyncTicketAnalyticsDataSet extends AbstractAssociativeDataSet
{
    /**
     * SyncTicketAnalyticsDataSet constructor.
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
                        'tickets'  => array(
                            array(
                                'id' =>'123',
                                'views_count' => 100,
                                'comments_count' => 2,
                            ),
                            array(
                                'id' =>'234',
                                'views_count' => 200,
                                'comments_count' => 4,
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'http_code' => 200,
                'http_body' => array(
                    array(
                        'id' =>'123',
                        'view_post_url' => 'http://test.com/123',
                        'views_count' => 100,
                        'comments_count' => 2,
                        'status' => 1,
                    ),
                    array(
                        'id' =>'234',
                        'view_post_url' => 'http://test.com/234',
                        'views_count' => 200,
                        'comments_count' => 4,
                        'status' => 1,
                    ),
                ),
                'handle_expect' => TicketEntity::class,
            ),
        );

        $variants['1.1'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'tickets'  => array(
                            array(
                                'id' =>'123',
                                'views_count' => 100,
                                'comments_count' => 2,
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'http_code' => 200,
                'http_body' => array(
                    array(
                        'id' =>'123',
                        'view_post_url' => 'http://test.com/123',
                        'views_count' => 100,
                        'comments_count' => 2,
                        'status' => 1,
                    ),
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
                        'tickets'  => array(
                            array(
                                'id' =>'123',
                                'views_count' => 100,
                                'comments_count' => 2,
                            ),
                        ),
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
                        'tickets'  => array(),
                    ),
                ),
            ),
            array(
                'http_code' => 422,
                'http_body' => array(
                    'message' => 'Ticket id or view post url has not been passed',
                ),
                'handle_expect' => UnprocessableEntityException::class,
            ),
        );

        $variants['4.'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'tickets'  => array(
                            array(
                                'id' =>'123',
                                'views_count' => 100,
                                'comments_count' => 2,
                            ),
                            array(
                                'id' =>'234',
                                'views_count' => 200,
                                'comments_count' => 4,
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'http_code' => 502,
                'http_body' => array(),
                'handle_expect' => ServerException::class,
            ),
        );

        $variants['4.1'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'tickets'  => array(
                            array(
                                'id' =>'123',
                                'views_count' => 100,
                                'comments_count' => 2,
                            ),
                            array(
                                'id' =>'234',
                                'views_count' => 200,
                                'comments_count' => 4,
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'http_code' => 503,
                'http_body' => array(),
                'handle_expect' => ServerException::class,
            ),
        );

        $variants['4.2'] = array(
            array(
                'space' => 'test-space',
                'options' => array(
                    'json' => array(
                        'token' => 'P9mYAXprVQBG9PFQwLiSzv8VyUbfXt6cP9mYAXprVQBG9PFQwL',
                        'tickets'  => array(
                            array(
                                'id' =>'123',
                                'views_count' => 100,
                                'comments_count' => 2,
                            ),
                            array(
                                'id' =>'234',
                                'views_count' => 200,
                                'comments_count' => 4,
                            ),
                        ),
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
