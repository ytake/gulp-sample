<?php
namespace Acme\Repositories;

/**
 * Class UserRepository
 * @package Acme\Repositories
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class UserRepository implements UserRepositoryContract
{

    /** @var array  */
    protected $user = [
        'user_id' => 2,
        'name' => 'gulp.test5'
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
