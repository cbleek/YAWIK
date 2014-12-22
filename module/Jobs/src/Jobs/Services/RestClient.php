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

use Zend\Http\Client as ZendClient;
use Zend\Http\Request;

class RestClient extends ZendClient
{
    protected $config;

    /**
     * etablish all parameters to the AMS-Server
     * these are quite good default-parameter for all REST-Clients
     *
     * notice: PHP_AUTH_USER and PHP_AUTH_PW are the basic-authentification parameter,
     * they are set by setAuth($user, $pw)
     * at the client they are with available at the $_SERVER['PHP_AUTH_USER'] and $_SERVER['PHP_AUTH_PW'] again
     * @param array $config
     */
    public function __construct($uri, array $config)
    {
        if (!array_key_exists('PHP_AUTH_USER', $config)) {
            throw new \RuntimeException('PHP_AUTH_USER for sending Job to MiT missing', 500);
        }
        if (!array_key_exists('PHP_AUTH_PW', $config)) {
            throw new \RuntimeException('PHP_AUTH_PW for sending Job to MiT missing', 500);
        }

        $auth = $config['PHP_AUTH_USER'];
        $pw = $config['PHP_AUTH_PW'];
        unset($config['PHP_AUTH_USER'], $config['PHP_AUTH_PW']);
        // pretty working out defaults
        $config = \Zend\Stdlib\ArrayUtils::merge( array(
                'adapter' => 'Zend\Http\Client\Adapter\Socket',
                'httpversion' => Request::VERSION_11,
                'keepalive' => False,
                'encodecookies' => False,
                'timeout' => 30,
                'storeresponse' => False,
                'outputstream' => False,
                'maxredirects' => 0,
                'method' => 'post'),
            $config);
        $this->config = $config;

        parent::__construct($uri, $config);

        $this->setAuth($auth, $pw);
    }

    public function __invoke($key = null, $module = null)
    {
        return $this->get($key, $module);
    }
}