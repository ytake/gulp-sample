<?php
namespace Acme\Actions;

use Acme\Foundation\Action;
use Acme\WebViews\Index as IndexView;
use Iono\Container\Annotation\Annotations\Autowired;

/**
 * Class Index
 * @package Acme\Actions
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Index extends Action
{

    /**
     * @var \Acme\Repositories\UserRepositoryContract
     * @Autowired("Acme\Repositories\UserRepositoryContract")
     */
    protected $user;

    /** @var IndexView  */
    protected $view;

    /**
     * @param IndexView $view
     */
    public function __construct(IndexView $view)
    {
        $this->view = $view;
    }

    /**
     * @return $this|IndexView
     */
    protected function action()
    {
        return $this->view->render(['name' => 'gulp']);
    }

}
