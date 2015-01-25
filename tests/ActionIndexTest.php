<?php

class ActionIndexTest extends TestSupport
{
    /** @var \Acme\Actions\Index  */
    protected $action;

    public function setUp()
    {
        $this->action = new \Acme\Actions\Index(
            new \Acme\WebViews\Index,
            new \Acme\Repositories\UserRepository
        );
    }

    public function testAction()
    {
        $this->assertInstanceOf("Acme\Actions\Index", $this->action);
    }

    public function testViewInstance()
    {
        $this->assertInstanceOf("Acme\WebViews\Index", $this->action->action());
    }
}
