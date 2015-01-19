<?php
namespace Acme\Repositories;

/**
 * Interface UserRepositoryContract
 * @package Acme\Repositories
 */
interface UserRepositoryContract
{

    /**
     * @param integer $userId
     * @return mixed
     */
    public function getUser($userId);

}
