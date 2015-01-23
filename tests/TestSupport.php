<?php

class TestSupport extends \PHPUnit_Framework_TestCase
{

    /**
     * @return $this
     * @throws Exception
     */
    protected function getContainer()
    {
        $config = new \Iono\Container\Configure();
        $compiler = new \Iono\Container\Compiler(
            new \Iono\Container\Annotation\AnnotationManager(),
            $config->set(require dirname(__FILE__) . '/../config/config.php')
        );
        $compiler->setForceCompile(false);
        $compilerContainer = new \Iono\Container\Container($compiler);
        return $compilerContainer->register();
    }
}