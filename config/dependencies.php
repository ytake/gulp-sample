<?php
/**
 * dependencies.php
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */

$container->instance('base_path', __DIR__ . '/..');
$container->bind(
    "Acme\Repositories\UserRepositoryContract",
    "Acme\Repositories\UserRepository"
);
