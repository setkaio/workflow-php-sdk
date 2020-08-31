<?php
namespace Setka\WorkflowSDK\Entities;

/**
 * Class TicketEntity
 */
class TicketEntity extends AbstractEntity
{
    /**
     * @var string Title of ticket.
     */
    protected $title;

    /**
     * @var string Ticket's category id.
     */
    protected $categoryId;

    /**
     * @var string Ticket's state.
     */
    protected $state;

    /**
     * @var \DateTime Ticket's date of publishing.
     */
    protected $publishedAt;

    /**
     * @var string Ticket's view post url.
     */
    protected $viewPostUrl;

    /**
     * @var string Ticket's edit post url.
     */
    protected $editPostUrl;

    /**
     * @var integer Ticket's views count.
     */
    protected $viewsCount = 0;

    /**
     * @var integer Ticket's comments count.
     */
    protected $commentsCount = 0;

    /**
     * TicketEntity constructor.
     *
     * @param string $id
     * @param string $title
     * @param string $categoryId
     * @param string $state
     * @param \DateTime $publishedAt
     * @param string $viewPostUrl
     * @param string $editPostUrl
     * @param int $viewsCount
     * @param int $commentsCount
     */
    public function __construct(
        $id = null,
        $title = null,
        $categoryId = null,
        $state = null,
        $publishedAt = null,
        $viewPostUrl = null,
        $editPostUrl = null,
        $viewsCount = null,
        $commentsCount = null
    ) {
        $this->title         = $title;
        $this->categoryId    = $categoryId;
        $this->state         = $state;
        $this->publishedAt   = $publishedAt;
        $this->viewPostUrl   = $viewPostUrl;
        $this->editPostUrl   = $editPostUrl;
        $this->viewsCount    = (int) $viewsCount;
        $this->commentsCount = (int) $commentsCount;
    }


    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this For chain calls.
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param string $categoryId
     *
     * @return $this For chain calls.
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @return $this For chain calls.
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTime $publishedAt
     *
     * @return $this For chain calls.
     */
    public function setPublishedAt(\DateTime $publishedAt)
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getViewPostUrl()
    {
        return $this->viewPostUrl;
    }

    /**
     * @param string $viewPostUrl
     *
     * @return $this For chain calls.
     */
    public function setViewPostUrl($viewPostUrl)
    {
        $this->viewPostUrl = $viewPostUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getEditPostUrl()
    {
        return $this->editPostUrl;
    }

    /**
     * @param string $editPostUrl
     *
     * @return $this For chain calls.
     */
    public function setEditPostUrl($editPostUrl)
    {
        $this->editPostUrl = $editPostUrl;
        return $this;
    }

    /**
     * @return int
     */
    public function getViewsCount()
    {
        return $this->viewsCount;
    }

    /**
     * @param int $viewsCount
     *
     * @return $this For chain calls.
     */
    public function setViewsCount($viewsCount)
    {
        $this->viewsCount = $viewsCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getCommentsCount()
    {
        return $this->commentsCount;
    }

    /**
     * @param int $commentsCount
     *
     * @return $this For chain calls.
     */
    public function setCommentsCount($commentsCount)
    {
        $this->commentsCount = $commentsCount;
        return $this;
    }
}
