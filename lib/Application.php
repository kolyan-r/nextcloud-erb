<?php

namespace OCA\External_Recycle_Bin;

use OCP\AppFramework\App;
use OCP\EventDispatcher\IEventDispatcher;
use OCP\Files\Events\Node\BeforeNodeDeletedEvent;
use OCA\External_Recycle_Bin\Events\BeforeNodeDeletedListener;
use OCP\ILogger;

/**
 * Class Application
 * @package OCA\External_Recycle_Bin
 */
class Application extends App
{
    /**
     * Application constructor.
     */
    public function __construct()
    {
        parent::__construct('external_recycle_bin');
    }

    /**
     * @return ILogger
     */
    public function getLogger()
    {
        return $this->getContainer()->query(ILogger::class);
    }

    /**
     * @return void
     */
    public function registerEventListeners(): void
    {
        $this->registerBeforeNodeDeletedListener();
    }

    /**
     * @return IEventDispatcher
     */
    protected function getEventDispatcher()
    {
        return $this->getContainer()->query(IEventDispatcher::class);
    }

    /**
     * @return void
     */
    protected function registerBeforeNodeDeletedListener(): void
    {
        $this->getEventDispatcher()->addListener(
            BeforeNodeDeletedEvent::class,
            function (BeforeNodeDeletedEvent $event) {
                (new BeforeNodeDeletedListener($this, $event))->handle();
            }
        );
    }
}