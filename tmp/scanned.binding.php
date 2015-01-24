<?php
$this->bind("render", "Acme\Foundation\ViewRender");
$this->relations["render"] = "Acme\Foundation\ViewRender";
$this->bind("Acme\Repositories\UserRepositoryContract", "Acme\Repositories\UserRepository");
