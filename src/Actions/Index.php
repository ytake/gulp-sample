<?php
namespace Acme\Actions;

use Acme\Foundation\Action;
use Iono\Container\Annotation\Annotations\Autowired;

/**
 * Class Index
 * @package Acme\Actions
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @property \Acme\Repositories\UserRepositoryContract $user
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
        $html = "
        <!doctype html>
<html>
    <head>
        <title>full doc</title>
    </head>
    <body>" . $this->user->getUser(1)['name']. "</body>
</html>";
        $this->body = $html;
    }

}
