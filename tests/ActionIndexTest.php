<?php

class ActionIndexTest extends TestSupport
{
    /** @var \Acme\Actions\Index  */
    protected $action;

    public function setUp()
    {
        $container = $this->getContainer();
        $this->action = $container->make("Acme\Actions\Index");
    }

    public function testAction()
    {
        
    }
}