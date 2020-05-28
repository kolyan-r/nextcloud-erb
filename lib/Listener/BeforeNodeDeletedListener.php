<?php

namespace OCA\External_Recycle_Bin\Listener;

use OCA\External_Recycle_Bin\AppInfo\Application;
use OCP\EventDispatcher\Event;
use OCP\Files\Events\Node\BeforeNodeDeletedEvent;
use OC\Files\Node\Node;

/**
 * Class BeforeNodeDeletedListener
 * @package OCA\External_Recycle_Bin\Listener
 */
class BeforeNodeDeletedListener
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var GenericEvent
     */
    protected $event;

    /**
     * @var Node
     */
    protected $node;

    /**
     * BeforeNodeDeletedListener constructor.
     *
     * @param Application $app
     * @param GenericEvent $event
     *
     * @throws \Exception
     */
    public function __construct(Application $app, GenericEvent $event)
    {
        $this->app = $app;
        $this->event = $event;
        $this->node = $event->getSubject();
        if (!$this->node instanceof Node) {
            throw new \Exception('Subject not valid');
        }
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $path = $this->node->getPath();

        $this->app->getLogger()->error($path);
    }
}