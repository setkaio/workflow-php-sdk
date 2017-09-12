<?php
namespace Setka\WorkflowSDK;

class Endpoints
{
    const CATEGORIES = '/eapi/v3/%1$s/categories.json';

    const CATEGORY = '/eapi/v3/%1$s/categories/%2$s.json';

    const TICKETS_PUBLISH = '/eapi/v3/%1$s/tickets/%2$s/publish.json';

    const TICKETS_SYNC_ANALYTICS = '/eapi/v3/%1$s/tickets/sync_analytics.json';

    const TICKETS_UNPUBLISH = '/eapi/v3/%1$s/tickets/%2$s/unpublish.json';

    const TICKET = '/eapi/v3/%1$s/tickets/%2$s.json';
}
