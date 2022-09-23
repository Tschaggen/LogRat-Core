<?php

namespace LogRat\Core\Event;

use App\Service\ModuleRegistry;
use Symfony\Contracts\EventDispatcher\Event;

class RegisterEndpointEvent extends Event
{
    public const NAME = 'endpoint.register';

    protected ModuleRegistry $moduleRegistry;

    public function __construct(ModuleRegistry $moduleRegistry)
    {
        $this->moduleRegistry = $moduleRegistry;
    }

    public function getModuleRegistry() {
        return $this->moduleRegistry;
    }

}