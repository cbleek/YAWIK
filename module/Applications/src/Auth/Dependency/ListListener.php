<?php
/**
 * @filesource
 * @copyright https://yawik.org/COPYRIGHT.php
 * @license MIT
 * @author Miroslav Fedeleš <miroslav.fedeles@gmail.com>
 * @since 0.27
 */

namespace Applications\Auth\Dependency;

use Laminas\I18n\Translator\TranslatorInterface as Translator;
use Auth\Entity\UserInterface as User;
use Laminas\View\Renderer\PhpRenderer as View;
use Auth\Dependency\ListInterface;
use Auth\Dependency\ListItem;
use Applications\Repository\Application as Repository;

class ListListener implements ListInterface
{

    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        return $this;
    }

    /**
     * @see \Auth\Dependency\ListInterface::getTitle()
     */
    public function getTitle(Translator $translator)
    {
        return $translator->translate('Applications');
    }

    /**
     * @see \Auth\Dependency\ListInterface::getCount()
     */
    public function getCount(User $user)
    {
        return $this->repository->getUserApplications($user->getId())->count();
    }

    /**
     * @see \Auth\Dependency\ListInterface::getItems()
     */
    public function getItems(User $user, View $view, $limit)
    {
        $items = [];

        foreach ($this->repository->getUserApplications($user->getId(), $limit) as $application) /* @var $application \Applications\Entity\Application */
        {
            $title = $application->getJob()->getTitle();
            $title .= ' ('. $view->dateFormat($application->getDateCreated()) . ')';
            $url = $view->url('lang/applications/detail', ['id' => $application->getId()]);
            $items[] = new ListItem($title, $url);
        }

        return $items;
    }

    /**
     * @see \Auth\Dependency\ListInterface::getEntities()
     */
    public function getEntities(User $user)
    {
        return $this->repository->getUserApplications($user->getId());
    }
}
