<?php

namespace LogRat\Core\Event;

use LogRat\Core\Service\EndpointRegistry;
use Symfony\Contracts\EventDispatcher\Event;

class RegisterEndpointEvent extends Event
{
    public const NAME = 'lograt.core.endpoint.register';

    protected EndpointRegistry $endpointRegistry;

    public function __construct(EndpointRegistry $endpointRegistry)
    {
        $this->endpointRegistry = $endpointRegistry;
    }

    public function getModuleRegistry() {
        return $this->endpointRegistry;
    }

}