<?php
namespace LogRat\Core\EventListener;

use LogRat\Core\Event\RegisterEndpointEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

#[AsEventListener(event: RegisterEndpointEvent::class, method: 'omModuleRegister')]
final class TestEventListener{

    public function onModuleRegister(RegisterEndpointEvent $event)
    {
        echo 'eyyyyyyyyy';
    }
}