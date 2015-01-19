<?php
namespace Acme\Actions;

use Acme\Foundation\Action;
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

    /**
     *
     */
    protected function action()
    {
        // dump($this->parameters);
        $this->body = $this->user->getUser(1)['name'];
    }

}
