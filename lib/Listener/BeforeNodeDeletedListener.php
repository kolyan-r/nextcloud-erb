<?php

namespace OCA\External_Recycle_Bin\Listener;

use OCP\Files\Events\Node\BeforeNodeDeletedEvent;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

/**
 * Class BeforeNodeDeletedListener
 * @package OCA\External_Recycle_Bin\Listener
 */
class BeforeNodeDeletedListener implements IEventListener
{
    /**
     * @param Event $event
     */
    public function handle(Event $event): void
    {
        if (!($event instanceOf BeforeNodeDeletedEvent)) {
            return;
        }

        $path = $event->getNode()->getPath();

        $this->app->getLogger()->error($path);
    }
}