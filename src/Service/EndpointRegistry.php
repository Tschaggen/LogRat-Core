<?php

namespace LogRat\Core\Service;

use LogRat\Core\Exception\EndpointRegisterException;

class EndpointRegistry
{
    private ApiRegistry $apiRegistry;

    public function __construct(ApiRegistry $apiRegistry) {
        $this->apiRegistry = $apiRegistry;
    }

    public function addEndpoint(string $endpoint,string $module,string $key,array $options) : void{

        $secKey = $this->apiRegistry->getKey($module);

        if($secKey === '') {
            throw new EndpointRegisterException("Module {$module} does not exist.",1);
        }

        if($secKey !== $key) {
            throw new EndpointRegisterException("Wrong key for module {$module}.",2);
        }

        $validatedOptions = [];

        if(!array_key_exists('callback',$options)) {
            throw new EndpointRegisterException("No defined callback function for endpoint {$endpoint}.",3);
        }

        $validatedOptions['callback'] = $options['callback'];

        if (array_key_exists('security_level',$options)) {
            $validatedOptions['security_level'] = $options['security_level'];
        }
        else {
            $validatedOptions['security_level'] = UserHandler::SECURITY_LEVEL_NONE;
        }

        if (array_key_exists($endpoint,$this->apiRegistry->getApiEndpoints($module))) {
            throw new EndpointRegisterException("Endpoint {$endpoint} already exists.",4);
        }

        $this->apiRegistry->addEndpoint($endpoint,$module,$validatedOptions);
    }

    public function getEndpoints($module) : array{

        $moduleEndpoints = $this->apiRegistry->getApiEndpoints($module);
        if ($moduleEndpoints === []) {
            throw new EndpointRegisterException("Module {$module} does not exist.",1);
        }

        return array_keys($moduleEndpoints);
    }

    public function getEndpointData($module,$endpoint) : array{
        $moduleEndpoints = $this->apiRegistry->getApiEndpoints($module);
        if ($moduleEndpoints === []) {
            throw new EndpointRegisterException("Module {$module} does not exist.",1);
        }

        if (!array_key_exists($endpoint,$moduleEndpoints)) {
            throw new EndpointRegisterException("The endpoint {$endpoint} does not exist in the module {$module}",5);
        }

        return $moduleEndpoints[$endpoint];
    }
}