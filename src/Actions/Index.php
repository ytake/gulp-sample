<?php
namespace Acme\Actions;

use Acme\Foundation\Action;
use Acme\WebViews\Index as IndexView;
use Acme\Repositories\UserRepositoryContract;

/**
 * Class Index
 * @package Acme\Actions
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Index extends Action
{

    /** @var UserRepositoryContract  */
    protected $user;

    /** @var IndexView  */
    protected $view;

    /**
     * @param IndexView $view
     * @param UserRepositoryContract $user
     */
    public function __construct(IndexView $view, UserRepositoryContract $user)
    {
        $this->view = $view;
        $this->user = $user;
    }

    /**
     * @return $this|IndexView
     */
    public function action()
    {
        return $this->view->render($this->user->getUser(2));
    }

}
