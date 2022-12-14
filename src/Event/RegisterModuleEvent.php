<?php

namespace LogRat\Core\Event;

use LogRat\Core\Service\ModuleRegistry;
use Symfony\Contracts\EventDispatcher\Event;

class RegisterModuleEvent extends Event
{
    public const NAME = 'lograt.core.module.register';

    protected ModuleRegistry $moduleRegistry;

    public function __construct(ModuleRegistry $moduleRegistry)
    {
        $this->moduleRegistry = $moduleRegistry;
    }

    public function getModuleRegistry() {
        return $this->moduleRegistry;
    }

}