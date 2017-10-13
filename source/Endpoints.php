<?php
namespace Setka\WorkflowSDK;

/**
 * Class Endpoints
 */
class Endpoints
{
    const API = 'https://workflow.setka.io/';

    /**
     * %1$s - space slug
     */
    const CATEGORIES = '/eapi/v3/%1$s/categories.json';

    /**
     * %1$s - space slug
     * %2$s - category ID
     */
    const CATEGORY = '/eapi/v3/%1$s/categories/%2$s.json';

    /**
     * %1$s - space slug
     * %2$s - ticket ID
     */
    const TICKETS_PUBLISH = '/eapi/v3/%1$s/tickets/%2$s/publish.json';

    /**
     * %1$s - space slug
     */
    const TICKETS_SYNC_ANALYTICS = '/eapi/v3/%1$s/tickets/sync_analytics.json';

    /**
     * %1$s - space slug
     * %2$s - ticket ID
     */
    const TICKETS_UNPUBLISH = '/eapi/v3/%1$s/tickets/%2$s/unpublish.json';

    /**
     * %1$s - space slug
     * %2$s - ticket ID
     */
    const TICKET = '/eapi/v3/%1$s/tickets/%2$s.json';

    /**
     * Get space info for current API key.
     */
    const SPACE = '/eapi/v3/space.json?token=%1$s';
}
