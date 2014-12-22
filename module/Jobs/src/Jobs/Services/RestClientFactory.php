<?php
/**
 * YAWIK
 * 
 * @filesource
 * @copyright (c) 2013-2014 Cross Solution (http://cross-solution.de)
 * @license   MIT
 * @author    weitz@cross-solution.de
 */

namespace Jobs\Services;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RestClientFactory implements FactoryInterface
{
    /**
     * Create the settings service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ControllerManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        if (!array_key_exists('CamMediaintown', $config)) {
            throw new \RuntimeException('configuration for Contact CamMediaintown is missing', 500);
        }
        if (!array_key_exists('restServer', $config['CamMediaintown'])) {
            throw new \RuntimeException('configuration restServer for CamMediaintown is missing', 500);
        }
        $camMediaIntown_RestServer = $config['CamMediaintown']['restServer'];
        if (!array_key_exists('uri', $camMediaIntown_RestServer)) {
            throw new \RuntimeException('uri for Rest-Server CamMediaintown is missing', 500);
        }
        $uri = $camMediaIntown_RestServer['uri'];
        $service = new RestClient($uri, $camMediaIntown_RestServer);
        return $service;
    }
}