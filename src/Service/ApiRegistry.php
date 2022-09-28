<?php

namespace LogRat\Core\Service;

class ApiRegistry
{
    private array $moduleKeys = [];
    private array $apiEndpoints = [];

    public function addModule(string $module,string $key) : void {
        $this->moduleKeys[$module] = $key;
        $this->apiEndpoints[$module] = [];
    }

    public function getModules() : array {
        return array_keys($this->moduleKeys);
    }

    public function getKey(string $module) : string{
        if(array_key_exists($module,$this->moduleKeys)) {
            return $this->moduleKeys[$module];
        }
        return '';
    }

    public function addEndpoint(string $endpoint,string $module,array $options = []) : void {
        $this->apiEndpoints[$module][$endpoint] = $options;
    }

    public function getApiEndpoints(?string $module = null) : array{
        if ($module === null) {
            return $this->apiEndpoints;
        }

        if (array_key_exists($module,$this->apiEndpoints)) {
            return $this->apiEndpoints[$module];
        }

        return [];
    }
}