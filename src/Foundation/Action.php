<?php
namespace Acme\Foundation;

use Iono\Container\Container;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Action
 * @package Acme\Foundation
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @property array $parameters
 */
abstract class Action
{

    /** @var */
    protected $parameters;

    /** @var   */
    protected $body = "<h2>sample</h2>";

    /** @var Container  */
    protected $container;

    /**
     * @return mixed
     */
    abstract protected function action();

    /**
     * @return Response
     */
    public function response()
    {

        return (new Response(
            (new Renderer(
                $this->container->make('base_path')))->renderer($this->action())
            )
        )->send();
    }

    /**
     * @param ParameterBag $params
     * @return $this
     */
    public function setParams(ParameterBag $params)
    {
        $this->parameters = $params->all();
        return $this;
    }

    /**
     * @param Container $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
        return $this;
    }
}
