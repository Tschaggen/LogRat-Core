<?php

namespace LogRat\Core;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class LogRatCore extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }
}