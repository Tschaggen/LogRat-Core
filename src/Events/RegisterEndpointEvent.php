<?php

namespace LogRat\Core\Events;

use LogRat\Core\Services\ModuleRegistry;
use Symfony\Contracts\EventDispatcher\Event;

class RegisterEndpointEvent extends Event
{
    public const NAME = 'module.register';

    protected ModuleRegistry $moduleRegistry;

    public function __construct(ModuleRegistry $moduleRegistry)
    {
        $this->moduleRegistry = $moduleRegistry;
    }

}