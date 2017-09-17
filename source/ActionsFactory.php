<?php
namespace Setka\WorkflowSDK;

use GuzzleHttp\Psr7\Request;

class ActionsFactory
{
    public static function create(API $api, $space)
    {
        $request = new Request('GET', 'eapi/v3/:space/categories.json');
    }
}
