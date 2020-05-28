<?php

namespace OCA\External_Recycle_Bin\AppInfo;

use OCP\AppFramework\App;
use OCP\EventDispatcher\GenericEvent;
use OCA\External_Recycle_Bin\Listener\BeforeNodeDeletedListener;
use OCP\Files\Events\Node\BeforeNodeDeletedEvent;

/**
 * Class Application
 * @package OCA\External_Recycle_Bin\AppInfo
 */
class Application extends App
{
    public const APP_ID = 'external_recycle_bin';

    /**
     * Application constructor.
     */
    public function __construct()
    {
        parent::__construct(self::APP_ID);

        $this->registerEventListeners();
    }

    /**
     * @return void
     */
    protected function registerEventListeners(): void
    {
        $this->registerBeforeNodeDeletedListener();
    }

    /**
     * @return IEventDispatcher
     */
    protected function getEventDispatcher()
    {
        return $this->getContainer()->getServer()->getEventDispatcher();
    }

    /**
     * @return void
     */
    protected function registerBeforeNodeDeletedListener(): void
    {
        $this->getEventDispatcher()->addServiceListener(
            BeforeNodeDeletedEvent::class,
            BeforeNodeDeletedListener::class
        );
    }
}