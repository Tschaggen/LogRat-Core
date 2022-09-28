<?php

namespace LogRat\Core\Service;

use LogRat\Core\Exception\ModuleRegisterException;

class ModuleRegistry
{
    private ApiRegistry $apiRegistry;

    public function __construct(ApiRegistry $apiRegistry) {
        $this->apiRegistry = $apiRegistry;
    }

    public function addModule(string $module) : string {

        $moduleKey = hash_hmac('sha256',(string)rand(1,10000000),'0');

        if(array_search($module,$this->apiRegistry->getModules())) {
            throw new ModuleRegisterException('Module already registered',1);
        }

        $this->apiRegistry->addModule($module,$moduleKey);
        return $moduleKey;
    }

    public function getModules() :array{
        return $this->apiRegistry->getModules();
    }
}