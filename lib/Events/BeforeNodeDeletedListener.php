<?php

namespace OCA\External_Recycle_Bin\Events;

use OCA\External_Recycle_Bin\Application;
use OCP\EventDispatcher\Event;
use OCP\Files\Events\Node\BeforeNodeDeletedEvent;

/**
 * Class BeforeNodeDeletedListener
 * @package OCA\External_Recycle_Bin\Events
 */
class BeforeNodeDeletedListener
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var BeforeNodeDeletedEvent
     */
    protected $event;

    /**
     * BeforeNodeDeletedListener constructor.
     *
     * @param Application $app
     * @param BeforeNodeDeletedEvent $event
     */
    public function __construct(Application $app, BeforeNodeDeletedEvent $event)
    {
        $this->app = $app;
        $this->event = $event;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $path = $this->event->getNode()->getPath();

        $this->app->getLogger()->alert($path);
    }
}