<?php
/**
 * @filesource
 * @copyright https://yawik.org/COPYRIGHT.php
 * @license MIT
 * @author Miroslav Fedeleš <miroslav.fedeles@gmail.com>
 * @since 0.27
 */

namespace Organizations\Factory\Auth\Dependency;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Organizations\Auth\Dependency\ListListener;

class ListListenerFactory implements FactoryInterface
{
    /**
     * Create a ListListener dependency
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return ListListener
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ListListener($container->get('repositories')->get('Organizations'));
    }
}
