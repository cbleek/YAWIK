<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright https://yawik.org/COPYRIGHT.php
 * @license       MIT
 */

namespace JobsTest\Factory\Controller;

use PHPUnit\Framework\TestCase;

use Jobs\Controller\IndexController;
use Jobs\Factory\Controller\IndexControllerFactory;
use CoreTest\Bootstrap;
use Laminas\Mvc\Controller\ControllerManager;

/**
 * Class IndexControllerFactoryTest
 * @package JobsTest\Factory\Controller
 */
class IndexControllerFactoryTest extends TestCase
{
    /**
     * @var IndexControllerFactory
     */
    private $testedObj;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->testedObj = new IndexControllerFactory();
    }

    /**
     *
     */
    public function testInvoke()
    {
        $sm = clone Bootstrap::getServiceManager();
        $sm->setAllowOverride(true);

        $jobRepositoryMock = $this->getMockBuilder('Jobs\Repository\Job')
            ->disableOriginalConstructor()
            ->getMock();

        $repositoriesMock = $this->getMockBuilder('Core\Repository\RepositoryService')
            ->disableOriginalConstructor()
            ->getMock();

        $repositoriesMock->expects($this->once())
            ->method('get')
            ->with('Jobs/Job')
            ->willReturn($jobRepositoryMock);

        $sm->setService('repositories', $repositoriesMock);

        $result = $this->testedObj->__invoke($sm, IndexController::class);

        $this->assertInstanceOf('Jobs\Controller\IndexController', $result);
    }
}
