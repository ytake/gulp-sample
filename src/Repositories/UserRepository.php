<?php
namespace Acme\Repositories;

use Iono\Container\Annotation\Annotations\Component;

/**
 * Class UserRepository
 * @package Acme\Repositories
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @Component
 */
class UserRepository implements UserRepositoryContract
{

    /** @var array  */
    protected $user = [
        'user_id' => 2,
        'name' => 'gulp.test1'
    ];

    /**
     * @param integer $userId
     * @return mixed
     */
    public function getUser($userId)
    {
        return $this->user;
    }

}
